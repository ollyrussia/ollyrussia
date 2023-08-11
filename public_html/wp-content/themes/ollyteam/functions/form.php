<?
    add_action( 'wp_ajax_sendFormLanding', 'sendFormLanding' );
	add_action( 'wp_ajax_nopriv_sendFormLanding', 'sendFormLanding' );
  
    add_action( 'wp_ajax_sendForm', 'sendForm' );
	add_action( 'wp_ajax_nopriv_sendForm', 'sendForm' );
	
	add_action( 'wp_ajax_inPerson', 'inPerson' );
	add_action( 'wp_ajax_nopriv_inPerson', 'inPerson' );
	
	add_action( 'wp_ajax_inIndivid', 'inIndivid' );
	add_action( 'wp_ajax_nopriv_inIndivid', 'inIndivid' );
	
	function sendForm()
	{
	$chat_id = 855127389; // Саsha
		//$chat_id = 687927961; //Женя
		//$chat_id = 361093437; //Мой

		$message_telegram = "Заявка на обратный звонок.\r\n
		Имя клиента: ".$_POST['recall_name']."\r\n
		Телефон клиента: ".$_POST['recall_phone']."\r\n
		Предпочитаем вид связи: ".$_POST['communication-type'];

		sendTelegram($chat_id, $message_telegram);
		sendTelegramSZ($message_telegram);
		
		$secret_key="YgdttYUbUltChMeMSukF4rk7y3ySrqNrJPB6nU1cd6x6WtECp6eEX5rUHvoLSUxc";
		$intagration_id="6bdbe3cf-e3c0-4e42-9586-c36d9abc6a78";
		$client_domen="alarikabox";
		$redirect_uri="https://ollyteam.ru/";
		$auth_token="def50200242e1b47aa7dc2b2f8826df6b97ee61cbb0e5fe2841e2c34af4db87ba1b99fd2e0f00132d0d5e89c7ec23893dd7a8993d7581f1965879a80c5f1b44222e72b0b3548e8e721ee340075a2c4f566ecd81a28ecaaa357f493fa4abb5f01649a94ca61bfbce9df0262205e972c0202810dbacf617ebccb8954db14c98575f78e112112b0dc234a903a708814410f665b9728ff6ed8d42e9d800d25569ffa1facf585e337246d22ed3cd926428298d1f4d48feaec3bf426299b7089c89e8cc540ba28049d22615b84ad6b3158c4981b84a0a6053931581007a2b342e1dc5b36076593a46bd721a1e7b9d3ff5237e48db0a2e3d347d8feb5c94ab09ba21dd778e0b548514c468190ec0c05ba0f3e0b9a364501628a075c285f3c42d58fd4e4f16b12716a052e335e0b4c1af3034dcac56954992d379a19469545fdcd747a64c1504b92ace49393bda21c554dc9283f06eb2c654d07c24b9588aefd7b715c3351b10354d218fd72696ddf13772197162352d3b5a9cf2c22d9f8a588a1785827c8742aa102638554ec035a817fc77d2c814cef39e4afd3879bee9e9ab798cf81c99854839ff7448268e1ebfaa02b73b31a1be12a64d20457accedb0664e8440334e8424e28c3f397b8f1e4e21fff439369bb8733c0f20fa497a2ed12ca53cf6879f6eda9a2";

		file_put_contents('amo.log', date('Y-m-d H:i:s')." - ".'========================================================'."\n", FILE_APPEND | LOCK_EX);
		
		//Добавляем в амо
		
		$amocrm = new EbClientAmocrm($secret_key, $intagration_id, $client_domen, $redirect_uri, $auth_token);
		

		if ($contact[0]!=200) {
			$contact_config = [
				'first_name'=>$_POST['recall_name'],
	            'last_name'=>'',
	            'custom_fields_values' => [
			        [
			            'field_id' => 144463, // поле телефона
			            'value' => $_POST['recall_phone'],
			            //'enum' => '204537'
			        ]
			    ]
			];
			$id_run = $amocrm->create_contact($contact_config);
			$account_id = $id_run[1]["_embedded"]["contacts"][0]["id"];
			file_put_contents('amo.log', date('Y-m-d H:i:s')." 2 ".json_encode($id_run, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		} else $account_id = $contact[1]["_embedded"]["contacts"][0]["id"];
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 5 ".$account_id."\n", FILE_APPEND | LOCK_EX);
		
		$name_fin='Заявка на обратный звонок '.$_POST['communication-type'];
		
		$lead_config = array(
		    'name' => $name_fin,
		    //'price'=> 0,
		    'responsible_user_id' => 7709800, // Ответственный - СЗ
		    'account_id' => $account_id,
			'tags_id' => 300767, // Тег "Терапия"
			//	'field_id' => 661887, // Терапевт 
			//	'enum_id'=>$enum_id,
		    'custom_fields_values' => [
				[
			        'field_id' => 670967, // Источник
			        'enum_id' => 508949, // сайт Olliteam
			    ],
		    ],
		);
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 3 ".json_encode($lead_config, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		$lead = $amocrm->create_lead($lead_config);
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 4 ".json_encode($lead, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		
		wp_die("Спасибо за заявку. В ближайшее время мы с Вами свяжемся.");
	}
	
	//----------------------------------------------------------------------
	
	function sendFormLanding()
	{
		global $wpdb;
		$chat_id = 855127389; // Саsha
		//$chat_id = 687927961; //Женя
		//$chat_id = 361093437; //Мой

		$message_telegram = "Заявка с ollyteam.ru/landing.\r\nИмя клиента: ".$_POST['landing_name']."\r\nПочта клиента: ".$_POST['landing_email']."\r\nТелефон клиента: ".$_POST['landing_phone'];
		sendTelegram($chat_id, $message_telegram);
		sendTelegramSZ($message_telegram);
		
		$wpdb->insert( 'wp_olly_landing', 
		[ 
			'name' => $_POST['landing_name'],
			'email' => $_POST['landing_email'],
			'phone' => $_POST['landing_phone'], 
			'utm_source' => $_POST['utm_source']?? 'Нет', 
			'utm_medium' => $_POST['utm_medium']?? 'Нет', 
			'utm_campaign' => $_POST['utm_campaign']?? 'Нет', 
			'utm_content' => $_POST['utm_content']?? 'Нет', 
			'utm_term' => $_POST['utm_term']?? 'Нет', 
		] 
		);

		wp_die("Спасибо за заявку. В ближайшее время мы с Вами свяжемся.");
	}	
	

	//---------------------------------------------------------------
	function inPerson()
	{
		$secret_key="YgdttYUbUltChMeMSukF4rk7y3ySrqNrJPB6nU1cd6x6WtECp6eEX5rUHvoLSUxc";
		$intagration_id="6bdbe3cf-e3c0-4e42-9586-c36d9abc6a78";
		$client_domen="alarikabox";
		$redirect_uri="https://ollyteam.ru/";
		$auth_token="def50200242e1b47aa7dc2b2f8826df6b97ee61cbb0e5fe2841e2c34af4db87ba1b99fd2e0f00132d0d5e89c7ec23893dd7a8993d7581f1965879a80c5f1b44222e72b0b3548e8e721ee340075a2c4f566ecd81a28ecaaa357f493fa4abb5f01649a94ca61bfbce9df0262205e972c0202810dbacf617ebccb8954db14c98575f78e112112b0dc234a903a708814410f665b9728ff6ed8d42e9d800d25569ffa1facf585e337246d22ed3cd926428298d1f4d48feaec3bf426299b7089c89e8cc540ba28049d22615b84ad6b3158c4981b84a0a6053931581007a2b342e1dc5b36076593a46bd721a1e7b9d3ff5237e48db0a2e3d347d8feb5c94ab09ba21dd778e0b548514c468190ec0c05ba0f3e0b9a364501628a075c285f3c42d58fd4e4f16b12716a052e335e0b4c1af3034dcac56954992d379a19469545fdcd747a64c1504b92ace49393bda21c554dc9283f06eb2c654d07c24b9588aefd7b715c3351b10354d218fd72696ddf13772197162352d3b5a9cf2c22d9f8a588a1785827c8742aa102638554ec035a817fc77d2c814cef39e4afd3879bee9e9ab798cf81c99854839ff7448268e1ebfaa02b73b31a1be12a64d20457accedb0664e8440334e8424e28c3f397b8f1e4e21fff439369bb8733c0f20fa497a2ed12ca53cf6879f6eda9a2";

		$chat_id = 855127389; // Саsha
		//$chat_id = 687927961; //Женя
		//$chat_id = 361093437; //Мой

		$message_telegram = "Заявка на очную консультацию.\r\n
		Имя клиента: ".$_POST['name_client']."\r\n
		Фамилия клиента: ".$_POST['surname_client']."\r\n
		Почта клиента: ".$_POST['email_client']."\r\n
		Телефон клиента: ".$_POST['phone_client']."\r\n
		Город: ".$_POST['city_text']."\r\n
		Направление терапии: ".$_POST['direction'];
		
		sendTelegram($chat_id, $message_telegram);
		if ($_POST['name_client']!='тест') sendTelegramSZ($message_telegram);
		
		file_put_contents('amo.log', date('Y-m-d H:i:s')." - ".'========================================================'."\n", FILE_APPEND | LOCK_EX);
		
		//Добавляем в амо
		
		$amocrm = new EbClientAmocrm($secret_key, $intagration_id, $client_domen, $redirect_uri, $auth_token);
		
		//file_put_contents('amo.log', date('Y-m-d H:i:s')." 0 ".json_encode($amocrm, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		

		// Получаем список тепарвевтов с амо из поля списка
		$field_id='661887';
		//$therapists_id = $amocrm->get_lead_custom_fields($field_id, '');
		//file_put_contents('amo.log', date('Y-m-d H:i:s')." 7 ".json_encode($therapists_id, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		// ищем id нужного терапевта
		//for ($ii=0; $ii<count($therapists_id[1]['enums']); $ii++) {
		//	$therapists_name=$therapists_id[1]['enums'][$ii]["value"];
		//	if (preg_match("/^[$therapists_name]+$/Uis", $_POST['therapist'])) {
		//		$enum_id=$therapists_id[1]['enums'][$ii]["id"];
		//		break;
		//	}
		//}
		
		$contact = $amocrm->get_contacts_by_pnone($_POST['phone_client']);
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 1 ".json_encode($contact, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		
		if ($contact[0]!=200) {
			$contact_config = [
				'first_name'=>$_POST['name_client'],
	            'last_name'=>$_POST['surname_client'],
	            'custom_fields_values' => [
			        [
			            'field_id' => 144463, // поле телефона
			            'value' => $_POST['phone_client'],
			            //'enum' => '204537'
			        ],
			        [
			            'field_id' => 144465, // поле мыла
			            'value' => $_POST['email_client'],
			            //'enum' => '204549'
			        ],
			    ]
			];
			$id_run = $amocrm->create_contact($contact_config);
			$account_id = $id_run[1]["_embedded"]["contacts"][0]["id"];
			file_put_contents('amo.log', date('Y-m-d H:i:s')." 2 ".json_encode($id_run, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		} else $account_id = $contact[1]["_embedded"]["contacts"][0]["id"];
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 5 ".$account_id."\n", FILE_APPEND | LOCK_EX);
		
		$name_fin='Заявка в '.$_POST['city_text'].' - '.$_POST['direction'];
		
		$lead_config = array(
		    'name' => $name_fin,
		    //'price'=> 0,
		    'responsible_user_id' => 7709800, // Ответственный - СЗ
		    'account_id' => $account_id,
			'tags_id' => 300767, // Тег "Терапия"
			//	'field_id' => 661887, // Терапевт 
			//	'enum_id'=>$enum_id,
		    'custom_fields_values' => [
				[
			        'field_id' => 670967, // Источник
			        'enum_id' => 508949, // сайт Olliteam
			    ],
		    ],
		);
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 3 ".json_encode($lead_config, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		$lead = $amocrm->create_lead($lead_config);
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 4 ".json_encode($lead, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		
		//$body='22149817';
		//$getlead = $amocrm->get_leads($body, '');
		//file_put_contents('amo.log', date('Y-m-d H:i:s')." 6 ".json_encode($getlead, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);

		wp_die("Спасибо за заявку. В ближайшее время мы с Вами свяжемся.");
	}	
	
	function inIndivid()
	{
		$secret_key="YgdttYUbUltChMeMSukF4rk7y3ySrqNrJPB6nU1cd6x6WtECp6eEX5rUHvoLSUxc";
		$intagration_id="6bdbe3cf-e3c0-4e42-9586-c36d9abc6a78";
		$client_domen="alarikabox";
		$redirect_uri="https://ollyteam.ru/";
		$auth_token="def50200242e1b47aa7dc2b2f8826df6b97ee61cbb0e5fe2841e2c34af4db87ba1b99fd2e0f00132d0d5e89c7ec23893dd7a8993d7581f1965879a80c5f1b44222e72b0b3548e8e721ee340075a2c4f566ecd81a28ecaaa357f493fa4abb5f01649a94ca61bfbce9df0262205e972c0202810dbacf617ebccb8954db14c98575f78e112112b0dc234a903a708814410f665b9728ff6ed8d42e9d800d25569ffa1facf585e337246d22ed3cd926428298d1f4d48feaec3bf426299b7089c89e8cc540ba28049d22615b84ad6b3158c4981b84a0a6053931581007a2b342e1dc5b36076593a46bd721a1e7b9d3ff5237e48db0a2e3d347d8feb5c94ab09ba21dd778e0b548514c468190ec0c05ba0f3e0b9a364501628a075c285f3c42d58fd4e4f16b12716a052e335e0b4c1af3034dcac56954992d379a19469545fdcd747a64c1504b92ace49393bda21c554dc9283f06eb2c654d07c24b9588aefd7b715c3351b10354d218fd72696ddf13772197162352d3b5a9cf2c22d9f8a588a1785827c8742aa102638554ec035a817fc77d2c814cef39e4afd3879bee9e9ab798cf81c99854839ff7448268e1ebfaa02b73b31a1be12a64d20457accedb0664e8440334e8424e28c3f397b8f1e4e21fff439369bb8733c0f20fa497a2ed12ca53cf6879f6eda9a2";

		$chat_id = 855127389; // Саsha
		//$chat_id = 687927961; //Женя
		//$chat_id = 361093437; //Мой

		$message_telegram = "Заявка на свободное окно.\r\n
		Имя клиента: ".$_POST['name_client']."\r\n
		Фамилия клиента: ".$_POST['surname_client']."\r\n
		Почта клиента: ".$_POST['email_client']."\r\n
		Телефон клиента: ".$_POST['phone_client']."\r\n
		Психолог: ".$_POST['therapist']."\r\n
		Направление терапии: ".$_POST['direction'];
		
		sendTelegram($chat_id, $message_telegram);
		if ($_POST['name_client']!='тест') sendTelegramSZ($message_telegram);
		
		file_put_contents('amo.log', date('Y-m-d H:i:s')." - ".'========================================================'."\n", FILE_APPEND | LOCK_EX);
		
		$amocrm = new EbClientAmocrm($secret_key, $intagration_id, $client_domen, $redirect_uri, $auth_token); 
		
		//file_put_contents('amo.log', date('Y-m-d H:i:s')." 0 ".json_encode($amocrm, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
			
		//Добавляем в амо 

		// Получаем список тепарвевтов с амо из поля списка
		$field_id='661887';
		$therapists_id = $amocrm->get_lead_custom_fields($field_id, '');
		//file_put_contents('amo.log', date('Y-m-d H:i:s')." 7 ".json_encode($therapists_id, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		// ищем id нужного терапевта
		for ($ii=0; $ii<count($therapists_id[1]['enums']); $ii++) {
			$therapists_name=$therapists_id[1]['enums'][$ii]["value"];
			if (preg_match("/^[$therapists_name]+$/Uis", $_POST['therapist'])) {
				$enum_id=$therapists_id[1]['enums'][$ii]["id"];
				break;
			}
		}
		
		$contact = $amocrm->get_contacts_by_pnone($_POST['phone_client']);
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 1 ".json_encode($contact, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		
		if ($contact[0]!=200) {
			$contact_config = [
				'first_name'=>$_POST['name_client'],
	            'last_name'=>$_POST['surname_client'],
	            'custom_fields_values' => [
			        [
			            'field_id' => 144463, // поле телефона
			            'value' => $_POST['phone_client'],
			            //'enum' => '204537'
			        ],
			        [
			            'field_id' => 144465, // поле мыла
			            'value' => $_POST['email_client'],
			            //'enum' => '204549'
			        ],
			    ]
			];
			$id_run = $amocrm->create_contact($contact_config);
			$account_id = $id_run[1]["_embedded"]["contacts"][0]["id"];
			file_put_contents('amo.log', date('Y-m-d H:i:s')." 2 ".json_encode($id_run, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		} else $account_id = $contact[1]["_embedded"]["contacts"][0]["id"];
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 5 ".$account_id."\n", FILE_APPEND | LOCK_EX);
		
		$name_fin='Заявка на свободное окно к '.$_POST['therapist'].' '.$_POST['direction'];
		
		$lead_config = array(
		    'name' => $name_fin,
		    'responsible_user_id' => 7709800, // Ответственный - СЗ
		    'account_id' => $account_id,
			'tags_id' => 300767, // Тег "Терапия"
		    'custom_fields_values' => [
		        [
		            'field_id' => 661887, // Терапевт 
					'enum_id'=>$enum_id,
		        ],
				[
			        'field_id' => 670967, // Источник
			        'enum_id' => 508949, // сайт Olliteam
			    ],
		    ],
		);
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 3 ".json_encode($lead_config, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		$lead = $amocrm->create_lead($lead_config);
		file_put_contents('amo.log', date('Y-m-d H:i:s')." 4 ".json_encode($lead, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		
		//$body='22149817';
		//$getlead = $amocrm->get_leads($body, '');
		//file_put_contents('amo.log', date('Y-m-d H:i:s')." 6 ".json_encode($getlead, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);

		wp_die("Спасибо за заявку. В ближайшее время мы с Вами свяжемся.");

	}
	
	
	
	
	
