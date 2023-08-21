<?php

require 'ApiClient.php';
$ApiClient = new ApiClient('7fa0c9e134fb4f0bf12fde5aee570c6e');

use AmoCRM\Client\AmoCRMApiClient;

include_once __DIR__ . '/vendor/autoload.php';

use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Collections\LinksCollection;
use AmoCRM\Collections\NullTagsCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Filters\LeadsFilter;
use AmoCRM\Models\CompanyModel;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\BirthdayCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\DateTimeCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\TextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\NullCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use Carbon\Carbon;
use League\OAuth2\Client\Token\AccessTokenInterface;

include_once __DIR__ . '/bootstrap.php';

$accessToken = getToken();

$apiClient->setAccessToken($accessToken)
    ->setAccountBaseDomain($accessToken->getValues()['baseDomain'])
    ->onAccessTokenRefresh(
        function (AccessTokenInterface $accessToken, string $baseDomain) {
            saveToken(
                [
                    'accessToken' => $accessToken->getToken(),
                    'refreshToken' => $accessToken->getRefreshToken(),
                    'expires' => $accessToken->getExpires(),
                    'baseDomain' => $baseDomain,
                ]
            );
        }
    );
	
//Ловим вебхук от амо	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	$fh = fopen("webhook.txt", 'a') or die("Сбой открытия");
    $data = json_decode(json_encode($_POST),true);	
	


	try {
		
		//Вытаскиваем лид
		$lead = $apiClient->leads()->getOne($data['leads']['add'][0]['id'], [LeadModel::CONTACTS]);	
		//Получаем контакты лида
		$leadContacts = $lead->getContacts();
		if ($leadContacts) {
			//Берем ид основного контакта
			$leadMainContact = $leadContacts->getBy('isMain', true)->toArray();
			//По ид получаем контакт
			$cont = $apiClient->contacts()->getOne($leadMainContact['id'])->toArray();	
			//Сама почта
			$email_amo = $cont['custom_fields_values'][1]['values'][0]['value'];
			
			//Отправляем в нотисенд
			$email = ['email' => $email_amo,'run_triggers'=>1];
			$ApiClient->addEmail(311863,$email);			
		}

	} catch (AmoCRMApiException $e) {
		printError($e);
		die;
	}
}


