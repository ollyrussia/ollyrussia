<?php
/*https://dev.ollyteam.ru/hub/getcourse_amo/leads_actions.php?positions={object.positions}&email={object.user.email}&first_name={object.user.first_name}&last_name={object.user.last_name}&phone={object.user.phone}&payed_money={object.payed_money}*/

error_reporting(E_ALL);
ini_set('log_errors', 'On');
ini_set('error_log', 'php_errors.log');

use AmoCRM\Filters\BaseRangeFilter;
use AmoCRM\Filters\Interfaces\HasOrderInterface;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\Factories\UnsortedModelFactory;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Leads\Unsorted\FormsUnsortedCollection;
use AmoCRM\Collections\Leads\Unsorted\SipUnsortedCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Filters\UnsortedFilter;
use AmoCRM\Filters\UnsortedSummaryFilter;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\Unsorted\BaseUnsortedModel;
use AmoCRM\Models\Unsorted\FormsMetadata;
use AmoCRM\Models\Unsorted\FormUnsortedModel;
use AmoCRM\Models\Unsorted\SipMetadata;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Ramsey\Uuid\Uuid;

include_once 'bootstrap.php';

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
	
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
	function generate_string($input, $strength = 16) {
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
	 
		return $random_string;
	}


	
	$filename = 'array.txt';

		
	if (empty($_GET['payed_money'])) {$_GET['payed_money']=0;}
	$price = trim(preg_replace("/[^0-9]/", '', $_GET['payed_money']));
	$id = generate_string($permitted_chars, 30);

	$externalData = [
		[
			'price' => $price,
			'name' => $_GET['positions'],
			'pipelineId' => 4254385,
			'statusId'=>39849793,
			'external_id'=> $id,
			'contact' => [
				'first_name' => $_GET['first_name'],
				'last_name' => $_GET['last_name'],
				'phone' => $_GET['phone'],
				'email' => $_GET['email'],
			],
			'tag' => 'getcourse',
		]

	];

	//Добавим в неразобранное форму
	$unsortedService = $apiClient->unsorted();
	$formsUnsortedCollection = new FormsUnsortedCollection();
	$formUnsorted = new FormUnsortedModel();
	$formMetadata = new FormsMetadata();
	$formMetadata
		->setFormId('form_health')
		->setFormName('Заявка')
		->setFormPage('ollyrussia.ru/mz')
		->setFormSentAt(mktime(date('h'), date('i'), date('s'), date('d'), date('m'), date('Y')))
		->setReferer('reffer')
		->setIp('192.168.0.1');

	$unsortedLead = new LeadModel();
	$unsortedLead->setName($_GET['positions'])
		->setPrice($price);

	$unsortedContactsCollection = new ContactsCollection();
	$unsortedContact = new ContactModel();
	$unsortedContact->setName($_GET['last_name']." ".$_GET['first_name']);
	
	$contactCustomFields = new CustomFieldsValuesCollection();
	
	$phoneFieldValueModel = new MultitextCustomFieldValuesModel();
	$phoneFieldValueModel->setFieldCode('PHONE');
	$phoneFieldValueModel->setValues(
		(new MultitextCustomFieldValueCollection())
			->add((new MultitextCustomFieldValueModel())->setValue($_GET['phone']))
	);
		
	$emailFieldValueModel = new MultitextCustomFieldValuesModel();
	$emailFieldValueModel->setFieldCode('EMAIL');
	$emailFieldValueModel->setValues(
		(new MultitextCustomFieldValueCollection())
			->add((new MultitextCustomFieldValueModel())->setValue($_GET['email']))
	);	
	$unsortedContact->setCustomFieldsValues($contactCustomFields->add($phoneFieldValueModel));
	$unsortedContact->setCustomFieldsValues($contactCustomFields->add($emailFieldValueModel));
	$unsortedContactsCollection->add($unsortedContact);
	

	$formUnsorted
		->setSourceName('Название источника')
		->setSourceUid('my_unique_uid')
		->setCreatedAt(time())
		->setMetadata($formMetadata)
		->setLead($unsortedLead)
		->setPipelineId(4254385)
		->setContacts($unsortedContactsCollection);

	$formsUnsortedCollection->add($formUnsorted);

	try {
		$formsUnsortedCollection = $unsortedService->add($formsUnsortedCollection);
	} catch (AmoCRMApiException $e) {
		printError($e);
		die;
	}

	/*

	$leadsCollection = new LeadsCollection();


	foreach ($externalData as $externalLead) {
		
		$leadCustomFieldsValues = new CustomFieldsValuesCollection();
		$textCustomFieldValueModel = new TextCustomFieldValuesModel();
		$textCustomFieldValueModel->setFieldId(661727);
		$textCustomFieldValueModel->setValues(
			(new TextCustomFieldValueCollection())
				->add((new TextCustomFieldValueModel())->setValue('Текст'))
		);
		$leadCustomFieldsValues->add($textCustomFieldValueModel);

		$lead = (new LeadModel())
			->setCustomFieldsValues($leadCustomFieldsValues);
			->setStatusId($externalLead['statusId'])
			->setName($externalLead['name'])
			->setPipelineId($externalLead['pipelineId'])
			->setPrice($externalLead['price'])
			->setTags(
				(new TagsCollection())
					->add(
						(new TagModel())
							->setName($externalLead['tag'])
					)
			)
			->setContacts(
				(new ContactsCollection())
					->add(
						(new ContactModel())
							->setFirstName($externalLead['contact']['first_name'])
							->setLastName($externalLead['contact']['last_name'])
							->setCustomFieldsValues(
								(new CustomFieldsValuesCollection())
									->add(
										(new MultitextCustomFieldValuesModel())
											->setFieldCode('PHONE')
											->setValues(
												(new MultitextCustomFieldValueCollection())
													->add(
														(new MultitextCustomFieldValueModel())
															->setValue($externalLead['contact']['phone'])
													)
											)
									)
									->add(
										(new MultitextCustomFieldValuesModel())
											->setFieldCode('EMAIL')
											->setValues(
												(new MultitextCustomFieldValueCollection())
													->add(
														(new MultitextCustomFieldValueModel())
															->setValue($externalLead['contact']['email'])
													)
											)
									)
							)

					)
			)->setRequestId($externalLead['external_id']);

		$leadsCollection->add($lead);
	}



	try {
		$addedLeadsCollection = $apiClient->leads()->addComplex($leadsCollection);
	} catch (AmoCRMApiException $e) {
		printError($e);
		die;
	}


	foreach ($addedLeadsCollection as $addedLead) {

		$leadId = $addedLead->getId();
		$contactId = $addedLead->getContacts()->first()->getId();

		$externalRequestIds = $addedLead->getComplexRequestIds();
		foreach ($externalRequestIds as $requestId) {
			$action = $addedLead->isMerged() ? 'обновлены' : 'созданы';
			$separator = PHP_SAPI === 'cli' ? PHP_EOL : "<br>";
			echo "Для сущности с ID {$requestId} были {$action}: сделка ({$leadId}), контакт ({$contactId}))" . $separator;
		}
	}*/
