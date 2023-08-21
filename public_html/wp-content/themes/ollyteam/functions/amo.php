<?
class EbClientAmocrm{
  
    function __construct($secret_key, $intagration_id, $client_domen, $redirect_uri, $auth_token) { 

        $this->config = array(
            'secret_key' => $secret_key, //секретный ключ 
            'intagration_id' => $intagration_id, // id интеграции
            'client_domen' => $client_domen, //домент данного аккаунта в AmoCRM
            'redirect_uri' => $redirect_uri,  //адресс редиректа
            'auth_token' => $auth_token //auth токен    
        );

        if (!file_exists('/home/c/cf78864/Ollyteam.ru/public_html/amo_login/'.$this->config['intagration_id'])) {
            mkdir('/home/c/cf78864/Ollyteam.ru/public_html/amo_login/'.$this->config['intagration_id'], 0777, true);
            file_put_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/refresh.txt", "");
            file_put_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/access.txt", "");
			
			$this::get_refresh();
        }

		$refresh_naw=file_get_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/refresh.txt");
		$access_naw=file_get_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/access.txt");

        if($refresh_naw=='' || $access_naw=='') $this::get_refresh(); //если token не указан, то создаем его
            
        $this->refresh = file_get_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/refresh.txt");
        $this->access = file_get_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/access.txt");
    }

    private function get_refresh(){ //создать первую пару токенов
        /** Соберем данные для запроса */
        $data = [
            'client_id' => $this->config['intagration_id'],
            'client_secret' => $this->config['secret_key'],
            'grant_type' => 'authorization_code',
            'code' => $this->config['auth_token'],
            'redirect_uri' => $this->config['redirect_uri'],
        ];
    
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
        curl_setopt($curl,CURLOPT_URL, "https://".$this->config['client_domen'].".amocrm.ru/oauth2/access_token");
        curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
        curl_setopt($curl,CURLOPT_HEADER, false);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $code = (int)$code;
        $response = json_decode($out, true);
        print_r($response);
        $r = array(
            "access_token" => $response['access_token'], //Access токен
            "refresh_token" => $response['refresh_token'], //Refresh токен
            "token_type" => $response['token_type'], //Тип токена
            "expires_in" => $response['expires_in'] //Через сколько действие токена истекает
        );
		
		//file_put_contents('amo.log', date('Y-m-d H:i:s')." 11 ".'Выдача новых данных для авторизации: '.json_encode($r, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		
        if(empty($r['access_token'])) //если результата нет - выводим ошибку
            die("Обновите auth токен!");
        else{
            //$accesstxt = fopen("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/access.txt", 'w') or die("не удалось создать файл");
            //$refreshtxt = fopen("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/refresh.txt", 'w') or die("не удалось создать файл");
			//
            //fwrite($accesstxt, $r['access_token']);
            //fwrite($refreshtxt, $r['refresh_token']);
			//
            //fclose($accesstxt);
            //fclose($refreshtxt);
			
			file_put_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/access.txt", $r['access_token']);
			file_put_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/refresh.txt", $r['refresh_token']);
        }
        return $r;
    }

    private function get_acess(){ //обновить access токен
        $link = 'https://' . $this->config['client_domen'] . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса

        $data = [
            'client_id' => $this->config['intagration_id'],
            'client_secret' => $this->config['secret_key'],
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refresh,
            'redirect_uri' => $this->config['redirect_uri'],
        ];

        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
        curl_setopt($curl,CURLOPT_HEADER, false);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $response = json_decode($out, true);
        $access_token = $response['access_token']; //Access токен
        $refresh_token = $response['refresh_token']; //Refresh токен
		
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 12 ".'Выдача нового access_token: '.json_encode($response, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		
        if(empty($access_token)){ //если результата нет - выводим ошибку 
            print_r($response);
            die("Произошла неизвестная ошибка!");
        }
        else{
		
			file_put_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/access.txt", $access_token);
			file_put_contents("/home/c/cf78864/Ollyteam.ru/public_html/amo_login/".$this->config['intagration_id']."/refresh.txt", $refresh_token);
        }
		
		//file_put_contents('amo.log', date('Y-m-d H:i:s')." 15 ".'Получение нового аксес токен: '.json_encode($response, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
    }

    private function request($link, $p = false,  $body=false, $headers = false, $date = ''){
        if(!$headers) $headers = ['Authorization: Bearer ' . $this->access];

        if($date != '')
            $headers[] = 'IF-MODIFIED-SINCE: '.$date.' UTC';

        $curl = curl_init(); #Сохраняем дескриптор сеанса cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL, $link);
        if($p===true){
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        }else if($p ==="PATCH"){
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
            $headers[] = 'Content-Type: application/json-patch+json';
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        }
        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl); 
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $code = (int) $code;
        $out = json_decode($out, true);
		
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 13 ".'Ответ запроса для проверки error_code: '.json_encode($out, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 14 ".'Статус: '.json_encode($out, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
        if(isset($out['response']) && $out['response']['error_code']==104){
            $this::get_acess();
            //$this::request($link, $p, $body);
        }
        if($out['response']['error_code'] == 110){
            $this::get_acess();
            //$this::request($link, $p, $body, $headers, $date);
        }
		if($out['status'] == 401){
            $this::get_acess();
        }
        //print_r($out);
		

        return [$code, $out];
    }

    public function create_note($id, $text){ //создает текстовое примечание к сделке

        $link = 'https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/notes';
    
        $data = array (
            'add' =>
            array (0 =>
              array (
                'element_id' => $id,
                'element_type' => '2',
                'text' => $text,
                'note_type' => '4',
              ),
            ),
          );
        return $this::request($link, true, $data);
    }

    public function create_contact($config){

		$contacts[0]["custom_fields_values"][0]["field_id"]=$config['custom_fields_values'][0]['field_id'];
		$contacts[0]["custom_fields_values"][0]["values"][0]["value"]=$config['custom_fields_values'][0]['value'];
		if (isset($config['custom_fields_values'][1]['field_id'])) $contacts[0]["custom_fields_values"][1]["field_id"]=$config['custom_fields_values'][1]['field_id'];
		if (isset($config['custom_fields_values'][1]['value'])) $contacts[0]["custom_fields_values"][1]["values"][0]["value"]=$config['custom_fields_values'][1]['value'];
		$contacts[0]["name"]=$config['last_name'].' '.$config['first_name'];

    
        $Response = $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/contacts', true, $contacts);
        return $Response;
    }

    public function create_task($task){
        $Response = $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/tasks', true, $task);
        return $Response;
    }
    public function create_lead($config){

		$leads[0]["name"]=$config['name'];
		//$leads[0]["account_id"]=$config['account_id'];
		$leads[0]["responsible_user_id"]=$config['responsible_user_id'];
		$leads[0]["_embedded"]["contacts"][0]['id']=$config['account_id'];
		$leads[0]["_embedded"]["tags"][0]['id']=$config['tags_id'];
		//$leads[0]["_embedded"]["tags"][0]['name']=$config['tags_name'];
		//$leads[0]["custom_fields_values"][0]['field_id']=$config['custom_fields_values'][0]['field_id'];
		//$leads[0]["custom_fields_values"][0]['values'][0]["enum_id"]=$config['custom_fields_values'][0]['enum_id'];
		
		foreach ($config['custom_fields_values'] as $index => $customField) {
			if (isset($customField['field_id'])) {
				$leads[0]["custom_fields_values"][$index]['field_id'] = $customField['field_id'];
			}
			if (isset($customField['enum_id'])) {
				$leads[0]["custom_fields_values"][$index]['values'][0]["enum_id"] = $customField['enum_id'];
			}
			if (isset($customField['values'])) {
				$leads[0]["custom_fields_values"][$index]['values'][0]['value'] = $customField['values'];
			}
		}


        $request = $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/leads', true, $leads);
        //return $request['_embedded']['items'][0]['id'];
		return $request;
    }

    public function update_tags($id_lead, $tags){
        $leads['update'] = array([
            'updated_at' => strtotime("now"),
            'id' => $id_lead,
            'tags' => $tags
        ]);
        $request = $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/leads', true, $leads);
        return $request;

    }

    public function update_tags_contacts($id_lead, $tags){
        $leads['update'] = array([
            'updated_at' => strtotime("now"),
            'id' => $id_lead,
            'tags' => $tags
        ]);
        $request = $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/contacts', true, $leads);
        return $request;

    }

    public function update_lead_status($id_lead, $id){
        $leads['update'] = array([
            'updated_at' => strtotime("now"),
            'id' => $id_lead,
            'status_id' => $id
        ]);
        $request = $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/leads', true, $leads);
        return $request;
    }

    public function update_lead($id_lead, $leads){ //'PATCH', 
        $url = 'https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/leads/'.$id_lead;
        print_r($url);
        $request = $this::request($url, "PATCH", $leads);
        return $request;
    }


    public function udpate_lead_custom_field($leadid, $idfield, $val){

        $lead = array(
            [
                'id' => $leadid,
                'updated_by' => 0,
                'custom_fields_values'=>array(
                    array(
                        'field_id'=>$idfield, 
                        'values'=>array("value" =>  [ 'value' => $val] )
                    ),
                )
            ]
        );

        // return json_encode($lead, JSON_PRETTY_PRINT);
        $request = $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/leads', "PATCH", $lead);
        return $request;
    }

    public function get_contacts($idContacts){ //выводит список всех контактов
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/contacts/'.$idContacts);
    }

	public function get_lead_custom_fields($field_id){ //выводит список поля лида
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/leads/custom_fields/'.$field_id);
    }

    public function get_leads($body = '', $date=''){
        if($date!='')
            return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/leads?'.$body, false, false, false, $date);
        else 
            return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/leads/'.$body);
    }
    public function get_all_leads($body){ 
        $data = [];
        $offset = 0;
        while (true){
            $bodys ='limit_rows=500$limit_offset='.$offset.'&'.$body;
            $leads = $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/leads?'.$bodys)[1]['_embedded']['items'];
            $url = '$offset+=500;
            $data[]=$leads';
            if(count($leads)<500){
                break;
            }
                
            echo $offset."\n";
            echo count($leads)."\n";
            echo $bodys."\n";
            print_r($leads[0]);
        }
        return $data;
    }

    public function api_pipelines(){ //статусы сделок 
        return $this::request('https://'. $this->config['client_domen'] . '.amocrm.ru/api/v2/account?with=pipelines');
    }

    public function api_account($body = ''){ //статусы сделок 
        return $this::request('https://'. $this->config['client_domen'] . '.amocrm.ru/api/v2/account?'.$body);
    }

    public function get_tags(){
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/leads/tags');
    }

    public function get_contacts_by_pnone($phone){ //выводит список всех контактов
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/contacts?query=' . $phone);
    }
    
    public function import_contacts($contact){ //импортируем контакты
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/contacts', true, $contact);
    }
    public function import_leads($leads){ //импортируем контакты
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/leads', true, $leads);
    }
    public function import_notes($body){
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/notes', true, $body);
    }
    public function get_notes($body){
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/notes?' . $body);
    }
    public function get_users($body = ''){
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/users?' . $body);
    }
    public function get_task($body){
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/tasks?' . $body);
    }
    public function create_pipelines($pipeline){
        return $request = $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/private/api/v2/json/pipelines/set', true, $pipeline);
    }
    public function get_by_url($url){
        return $this::request($url);
    }

    public function get_catalog_in_lead($leadId){
        // 'https://'.$this->config['client_domen'].'.amocrm.ru/ajax/v1/links/list?links[0][from]=leads&links[0][from_id]=<ID СДЕЛКИ>&links[0][to]=catalog_elements&links[0][from_catalog_id]=2&links[0][to_catalog_id]=<ID КАТАЛОГА>'
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v4/leads/'.$leadId.'?with=catalog_elements');

    }

    public function get_products_in_catalog($bodyAnswer){
        return $this::request('https://' . $this->config['client_domen'] . '.amocrm.ru/api/v2/catalog_elements?' . $bodyAnswer);
    }
}