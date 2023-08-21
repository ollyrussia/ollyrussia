<?php
	/*
	Template Name: Прием ответа с кассы
	*/

	global $wp_filesystem;
	global $wpdb;
	
	//// Установка ключа API, логина и пароля
	$api_key = 'rf55gcwyhzpa5h6xeb4c';
	$login = 'andrtos@gmail.com';
	$password = '2o7GMpVL!!4';
	
	require_once ('libs/yclients/YclientsApi.php');
	require_once ('libs/yclients/YclientsException.php');
	require_once ('libs/yclients/custom_ycl_v2.php');
	use Yclients\YclientsApi;	
	//rf55gcwyhzpa5h6xeb4c
	$yclients = new YclientsApi($api_key); 
	
	//Получаем токен
	$user = $yclients->getAuth($login, $password);
	$token = $user['data']['user_token'];

	//Идентификатор компании в якл
	$companyId=542516;

//// вводные данные

//// Идентификатор компании
$company_id = $companyId;
$expense_id=6; // платежная статья - покупка абонимента
$account_id=1734981; // идентификатор кассы
$storage_id=1076926;  // идентификатор склада 
//
//////////////////////////////////////////////////////
//$phone_number='79782593134';
//$email='taurus_f@mail.ru';
//$name="Тест Тестович2";
//
//$price_good=5; // стоимость
//
//$master_id='2568541'; // id психолога 
///////////////////////////////////////////////////////
//$name_good='Пакет терапий 5 2-й категории';
///////////////////////////////////////////////////////
//
//// получаем токен авторизации
//$user_token=get_user_token($company_id, $login, $password, $api_key);
$user_token=$token;
//// получаем id клиента по номеру телефона, если нет создаем
//$client_id = search_or_create_client($company_id, $user_token, $api_key, $phone_number, $email, $name);
//// создаем транзакцию пополнения счета на сумму стоимости товара
//addFinance($company_id, $price_good, $expense_id, $account_id, $client_id, $user_token, $api_key);
//// получаем id товара по названию и стоимости
//$id_good=getGoods($company_id, $name_good, $price_good, $user_token, $api_key);
//// создание складской операции для покупки товара
//$document_id=addOperation($company_id, $storage_id, $id_good, $price_good, $master_id, $client_id, $user_token, $api_key);
//// создание товарной транзакции для покупки товара
//$bay_good=buyGoods($company_id, $document_id, $id_good, $price_good, $master_id, $client_id, $user_token, $api_key);


///////////// AMO
	require_once (__DIR__.'/amo.php');

	$secret_key="YgdttYUbUltChMeMSukF4rk7y3ySrqNrJPB6nU1cd6x6WtECp6eEX5rUHvoLSUxc";
	$intagration_id="6bdbe3cf-e3c0-4e42-9586-c36d9abc6a78";
	$client_domen="alarikabox";
	$redirect_uri="https://ollyteam.ru/";
	$auth_token="def50200242e1b47aa7dc2b2f8826df6b97ee61cbb0e5fe2841e2c34af4db87ba1b99fd2e0f00132d0d5e89c7ec23893dd7a8993d7581f1965879a80c5f1b44222e72b0b3548e8e721ee340075a2c4f566ecd81a28ecaaa357f493fa4abb5f01649a94ca61bfbce9df0262205e972c0202810dbacf617ebccb8954db14c98575f78e112112b0dc234a903a708814410f665b9728ff6ed8d42e9d800d25569ffa1facf585e337246d22ed3cd926428298d1f4d48feaec3bf426299b7089c89e8cc540ba28049d22615b84ad6b3158c4981b84a0a6053931581007a2b342e1dc5b36076593a46bd721a1e7b9d3ff5237e48db0a2e3d347d8feb5c94ab09ba21dd778e0b548514c468190ec0c05ba0f3e0b9a364501628a075c285f3c42d58fd4e4f16b12716a052e335e0b4c1af3034dcac56954992d379a19469545fdcd747a64c1504b92ace49393bda21c554dc9283f06eb2c654d07c24b9588aefd7b715c3351b10354d218fd72696ddf13772197162352d3b5a9cf2c22d9f8a588a1785827c8742aa102638554ec035a817fc77d2c814cef39e4afd3879bee9e9ab798cf81c99854839ff7448268e1ebfaa02b73b31a1be12a64d20457accedb0664e8440334e8424e28c3f397b8f1e4e21fff439369bb8733c0f20fa497a2ed12ca53cf6879f6eda9a2";
/////////////////////	


	if (empty($wp_filesystem)) {
	    require_once (ABSPATH . '/wp-admin/includes/file.php');
	    WP_Filesystem();
	}
	        
	$content_raw =  $wp_filesystem->get_contents('php://input');
	$content = json_decode($content_raw,true);
	
	$event = $content['event'];
	$status = $content['object']['status'];
	$order = $content['object']['metadata']['order'];
	$code = $content['object']['metadata']['code'];
	$cart = $content['object']['metadata']['cart'];
	$packages = $content['object']['metadata']['packages'];
	
 
	//Бот менеджера
	$chat_id = 855127389; // Саsha
	//$chat_id = 687927961; //Женя
	//$chat_id = 361093437; //Мой
  
 
	#Проверка ответа по пакетам
	if (!empty($packages))
	{
		//Получаем информацию о заказе
		$sql = $wpdb->prepare( "SELECT * FROM wp_olly_packages WHERE id=%d", $packages );
		$order_info = $wpdb->get_row($sql);
	    
	    //Получаем информацию о терапевте
	    $therapist = get_user_by('id', $order_info->therapist);
	    $therapist_name = $therapist->display_name;
	    $therapist_email = $therapist->user_email;
	    $therapist_phone = get_the_author_meta( 'phone', $order_info->therapist );
	    $therapist_tg= get_the_author_meta( 'bot', $order_info->therapist );
	    
		    #УСПЕХ
		#---------------------------------------------------------------------------
		if ($status==="succeeded")
		{
			
			//Обновляем статус в корзине
			//--------------
			
			$update_booking = $wpdb->update( 'wp_olly_packages',
				array( 'status' => 'Оплачено'),
				array('id'=>$packages)
				
			);
			
			//В ТЕЛЕГРАМ СЛУЖБЕ ЗАБОТЫ
			
			$message_telegram = "Новая покупка пакета консультаций!\r\n Имя клиента: ".$order_info->name_client.
			"\r\n Фамилия клиента: ".$order_info->surname_client.
			"\r\n Телефон клиента: ".$order_info->phone_client.
			"\r\n Почта клиента: ".$order_info->email_client.
			"\r\n Тип пакета: ".$order_info->packages.
			"\r\n Терапевт: ".$therapist_name.	
			"\r\n Домен: ".$order_info->domen;			
			sendTelegram($chat_id, $message_telegram);	
			sendTelegramSZ($message_telegram);
			

			//В ТЕЛЕГРАМ ПСИХОЛОГУ
			//--------------
			
			$message_telegram = "Новая покупка пакета консультаций!\r\n Имя клиента: ".$order_info->name_client.
			"\r\n Фамилия клиента: ".$order_info->surname_client.
			"\r\n Телефон клиента: ".$order_info->phone_client.
			"\r\n Почта клиента: ".$order_info->email_client.
			"\r\n Тип пакета: ".$order_info->packages;
			
			sendTelegram($therapist_tg, $message_telegram);
			
			//ПИСЬМО ПСИХОЛОГУ
			//--------------
			
			$html='<p><span style="font-size: 16px;">Добрый день!</span><br>
					<span style="font-size: 16px;">У вас новая покупка пакета консультаций</span></p>
					<p><span style="font-size: 16px;">Данные клиента:</span></p>
					<p><span style="font-size: 16px;">Фио: '.$order_info->name_client.' '.$order_info->surname_client.'</span></p>
					<p><span style="font-size: 16px;">Почта: '.$order_info->email_client.'</span></p>
					<p><span style="font-size: 16px;">Телефон: '.$order_info->phone_client.'</span></p>
					<p><span style="font-size: 16px;">Тип пакета: '.$order_info->packages.'</span></p>';
			
			$emails = array(
			    'html' => $html,
			    'subject' => '[ollyteam] У вас новая покупка',
			    'from' => array(
			        'name' => 'Ольга Роменская',
			        'email' => 'info@ollyrussia.ru',
			    ),
			    'to' => array(
			        array(
			            'name' => $therapist_name,
			            'email' => $therapist_email,
			        ),
			    )
			);
		
			$SPApiClient->smtpSendMail($emails);
			
			
			//ПИСЬМО КЛИЕНТУ
			//--------------
			$html='<p><span style="font-size: 16px;">Здравствуйте!</span><br>
					<span style="font-size: 16px;">Ваша покупка пакета консультации подтверждена.</span></p>
					<p><span style="font-size: 16px;">Ваш психолог: '.$therapist_name.'</span></p>
					<p><span style="font-size: 16px;">Телефон психолога: '.$therapist_phone.'</span></p>
					<p><span style="font-size: 16px;">В блишайшее время с вами свяжется менеджер для уточнения деталей.</span></p>
					<p><span style="font-size: 16px;">Обязательно ознакомьтесь с <a href="https://ollyteam.ru/rules/">правилами проведения консультации</a> </span></p>
					<p><span style="font-size: 16px;">С уважением, команда Ольги Роменской.</span></p>';
			
			$emails = array(
			    'html' => $html,
			    'subject' => '[ollyteam] Покупка пакета консультации',
			    'from' => array(
			        'name' => 'Ольга Роменская',
			        'email' => 'info@ollyrussia.ru',
			    ),
			    'to' => array(
			        array(
			            'name' => $order_info->name_client,
			            'email' => $order_info->email_client,
			        ),
			    )
			);
	
	
			$SPApiClient->smtpSendMail($emails);
			
			// покупка абонемента в якл с пополением счета
			
			//// получаем id клиента по номеру телефона, если нет создаем
			$client_id = search_or_create_client($company_id, $user_token, $api_key, $order_info->phone_client, $order_info->email_client, $order_info->surname_client.' '.$order_info->name_client);
			//// создаем транзакцию пополнения счета на сумму стоимости товара
			//addFinance($company_id, $price_good, $expense_id, $account_id, $client_id, $user_token, $api_key);
			//// получаем id товара по названию и стоимости
			//$id_good=getGoods($company_id, $name_good, $price_good, $user_token, $api_key);
			//// создание складской операции для покупки товара
			//$document_id=addOperation($company_id, $storage_id, $id_good, $price_good, $master_id, $client_id, $user_token, $api_key);
			//// создание товарной транзакции для покупки товара
			//$bay_good=buyGoods($company_id, $document_id, $id_good, $price_good, $master_id, $client_id, $user_token, $api_key);
			
			// AMO в случае отключенной интеграции с якл ...............
			file_put_contents('amo.log', date('Y-m-d H:i:s')." ПАКЕТ ----------------------------------------------------------- "."\n", FILE_APPEND | LOCK_EX);			
			$amocrm = new EbClientAmocrm($secret_key, $intagration_id, $client_domen, $redirect_uri, $auth_token); 
			
			file_put_contents('amo.log', date('Y-m-d H:i:s')." ПАКЕТ 0 ".json_encode($amocrm, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
				
			//Добавляем в амо 
			
			// Получаем список тепарвевтов с амо из поля списка
			$field_id='661887';
			$therapists_id = $amocrm->get_lead_custom_fields($field_id, '');
			//file_put_contents('amo.log', date('Y-m-d H:i:s')." ПАКЕТ 7 ".json_encode($therapists_id, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
			// ищем id нужного терапевта
			for ($ii=0; $ii<count($therapists_id[1]['enums']); $ii++) {
				$therapists_name=$therapists_id[1]['enums'][$ii]["value"];
				if (preg_match("/^[$therapists_name]+$/Uis", $therapist_name)) { //////////////
					$enum_id=$therapists_id[1]['enums'][$ii]["id"];
					break;
				}
			}
			
			$contact = $amocrm->get_contacts_by_pnone($order_info->phone_client); //////////////////
			//file_put_contents('amo.log', date('Y-m-d H:i:s')." ПАКЕТ 1 ".json_encode($contact, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
			
			if ($contact[0]!=200) {
				$contact_config = [
					'first_name'=>$order_info->name_client, ///////////////////////////////////////////
					'last_name'=>$order_info->surname_client, //////////////////////////////////////
					'custom_fields_values' => [
						[
							'field_id' => 144463, // поле телефона
							'value' => $order_info->phone_client, /////////////////////////////////////
						],
						[
							'field_id' => 144465, // поле мыла
							'value' => $order_info->email_client, /////////////////////////////////////
						],
					]
				];
				$id_run = $amocrm->create_contact($contact_config);
				$account_id = $id_run[1]["_embedded"]["contacts"][0]["id"];
				file_put_contents('amo.log', date('Y-m-d H:i:s')." ПАКЕТ 2 ".json_encode($id_run, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
			} else $account_id = $contact[1]["_embedded"]["contacts"][0]["id"];
			file_put_contents('amo.log', date('Y-m-d H:i:s')." ПАКЕТ 5 ".$account_id."\n", FILE_APPEND | LOCK_EX);
			
			$name_fin='Покупка пакета '.$order_info->packages.' '.$therapist_name; ////////
			
			$lead_config = array(
				'name' => $name_fin,
				'price' => (int)$order_info->summa, ///////////////////////////////////////////////////////////////////
				'responsible_user_id' => 7709800, // Ответственный - СЗ
				'account_id' => $account_id,
				'tags_id' => 300767, // Тег "Терапия"
				'custom_fields_values' => [
					[
						'field_id' => 661887, // Терапевт 
						'enum_id'=>$enum_id, 
					],
					[
						'field_id' => 670967, // Источник сделки
						'enum_id' => 508949, // сайт Olliteam
					],
					[
						'field_id' => 674991, // Источник
						'values' => $order_info->domen, // домен Olliteam /////////////////////////
					],
					[
						'field_id' => 661773, // Онлайн оплата
						'values' => $order_info->summa, // сумма  //////////////////////////////////////
					],
				],
			);
			file_put_contents('amo.log', date('Y-m-d H:i:s')." ПАКЕТ 3 ".json_encode($lead_config, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
			$lead = $amocrm->create_lead($lead_config);
			file_put_contents('amo.log', date('Y-m-d H:i:s')." ПАКЕТ 4 ".json_encode($lead, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
		} 
		
		#ОШИБКА ПЛАТЕЖА
		#---------------------------------------------------------------------------
		elseif ($status==="canceled") {
		
			//Обновляем статус в календаре терапевта
			$update_booking = $wpdb->update( 'wp_olly_packages',
				array( 'status' => 'Ошибка оплаты'),
				array('id'=>$cart)
			);

			//Бот менеджера
			
			$message_telegram = "Пользователь не смог оплатить.\r\n
			Тип : ".$order_info->packages."\r\n
			Имя клиента: ".$order_info->name_client."\r\n 
			Фамилия клиента: ".$order_info->surname_client."\r\n 
			Телефон клиента: ".$order_info->phone_client."\r\n 
			Терапевт: ".$therapist_name.
			"\r\n Домен: ".$order_info->domen;
			
			sendTelegram($chat_id, $message_telegram);
			sendTelegramSZ($message_telegram);
			
		}
			
	}	
	
	#Проверка ответа по корзине
	elseif  (!empty($cart))
	{
		//Получаем информацию о заказе
		$sql = $wpdb->prepare( "SELECT * 
		FROM wp_olly_cart
		WHERE id_cart=%d", $cart );
		
		$order_info = $wpdb->get_row($sql);
		
		//Приводим даты в удобночитаемый вид
	    $date_ru = ruDate($order_info->date_cart,false);
	    $time_ru = ruDate($order_info->date_cart,true);
	    //Для амо
	    $date_amo = date_format(date_create($order_info->date_cart), 'd.m.Y H:i');
	    
	    //Получаем информацию о терапевте
	    $therapist = get_user_by('id', $order_info->therapist_cart);
	    $therapist_name = $therapist->display_name;
	    $therapist_email = $therapist->user_email;
	    $therapist_phone = get_the_author_meta( 'phone', $order_info->therapist_cart );
	    $therapist_tg= get_the_author_meta( 'bot', $order_info->therapist_cart );
	    
		    #УСПЕХ
		#---------------------------------------------------------------------------
		if ($status==="succeeded")
		{
			
			//Обновляем статус в корзине
			//--------------
			
			$update_booking = $wpdb->update( 'wp_olly_cart',
				array( 'status_cart' => 'Забронировано'),
				array('id_cart'=>$cart)
			);
			

			//В ТЕЛЕГРАМ ПСИХОЛОГУ
			//--------------
			
			$message_telegram = "Новая заявка!\r\n Имя клиента: ".$order_info->name_client.
			"\r\n Фамилия клиента: ".$order_info->surname_client.
			"\r\n Дата рождения: ".$order_info->birthday_client.
			"\r\n Телефон клиента: ".$order_info->phone_client.
			"\r\n Почта клиента: ".$order_info->email_client.
			"\r\n Дата терапии: ". $date_ru." ".$time_ru.
			"\r\n Запрос: ".$order_info->query_client.
			"\r\n Промокод: ".$order_info->promocode_client.
			"\r\n Сумма: ".$order_info->sum_client.
			"\r\n Тип терапии: заявка с заготовленной корзины!";
			
			sendTelegram($therapist_tg, $message_telegram);
			
			//ПИСЬМО ПСИХОЛОГУ
			//--------------
			
			$html='<p><span style="font-size: 16px;">Добрый день!</span><br>
					<span style="font-size: 16px;">У вас новая запись на терапию</span></p>
					<p><span style="font-size: 16px;">Дата терапии: '.$date_ru." ".$time_ru.'</span></p>
					<p><span style="font-size: 16px;">Данные клиента:</span></p>
					<p><span style="font-size: 16px;">Фио: '.$order_info->name_client.' '.$order_info->surname_client.'</span></p>
					<p><span style="font-size: 16px;">Дата рождения: '.$order_info->birthday_client.'</span></p>
					<p><span style="font-size: 16px;">Почта: '.$order_info->email_client.'</span></p>
					<p><span style="font-size: 16px;">Телефон: '.$order_info->phone_client.'</span></p>
					<p><span style="font-size: 16px;">Промокод: '.$order_info->promocode_client.'</span></p>
					<p><span style="font-size: 16px;">Сумма: '.$order_info->sum_client.'</span></p>
					<p><span style="font-size: 16px;">Тип терапии: заявка с заготовленной корзины!</span></p>';
			
			$emails = array(
			    'html' => $html,
			    'subject' => '[ollyteam] У вас новая запись на терапию',
			    'from' => array(
			        'name' => 'Ольга Роменская',
			        'email' => 'info@ollyrussia.ru',
			    ),
			    'to' => array(
			        array(
			            'name' => $therapist_name,
			            'email' => $therapist_email,
			        ),
			    )
			);
		
			$SPApiClient->smtpSendMail($emails);
			
			//СМС КЛИЕНТУ
			$sms_message = "Добрый день! Вы записаны на терапию на ".$date_ru." ".$time_ru." Ваш терапевт: ".$therapist_name;
			send_sms($sms_message,$order_info->phone_client);
			
			//ПИСЬМО КЛИЕНТУ
			//--------------
			$html='<p><span style="font-size: 16px;">Здравствуйте!</span><br>
					<span style="font-size: 16px;">Ваша запись к психологу подтверждена.</span></p>
					<p><span style="font-size: 16px;">Ваш психолог: '.$therapist_name.'</span></p>
					<p><span style="font-size: 16px;">Телефон психолога: '.$therapist_phone.'</span></p>
					<p><span style="font-size: 16px;">Дата и время сессии (время указано по Москве): '.$date_ru." ".$time_ru.'</span></p>
					<p><span style="font-size: 16px;">Обратите внимание, что вам может перезвонить или написать менеджер для уточнения деталей.</span></p>
					<p><span style="font-size: 16px;">Обязательно ознакомьтесь с <a href="https://ollyteam.ru/rules/">правилами проведения консультации</a> </span></p>
					<p><span style="font-size: 16px;">С уважением, команда Ольги Роменской.</span></p>';
			
			$emails = array(
			    'html' => $html,
			    'subject' => '[ollyteam] Вы успешно записаны на терапию',
			    'from' => array(
			        'name' => 'Ольга Роменская',
			        'email' => 'info@ollyrussia.ru',
			    ),
			    'to' => array(
			        array(
			            'name' => $order_info->name_client,
			            'email' => $order_info->email_client,
			        ),
			    )
			);
	
	
			$SPApiClient->smtpSendMail($emails);
			
			
			#Отправляем в уклиент
			
			$client = [
				"phone"=>$order_info->phone_client,
				"email"=>$order_info->email_client,
				"name"=>$order_info->surname_client." ".$order_info->name_client,
			];
			$datetime = new DateTime($order_info->date_cart);
			$y_date = $datetime->format(DateTime::ATOM);
			
			if ($order_info->type_cart=="Психология") {
				$service = get_the_author_meta( 'id_service_base_yclients', $order_info->therapist_cart );
				$duration = 3600;
			}
			elseif ($order_info->type_cart=="Насилие") {
				$service = get_the_author_meta( 'id_service_vi_yclients', $order_info->therapist_cart );
				$duration = 10800;
			}
			elseif ($order_info->type_cart=="Панические атаки") {
				$service = get_the_author_meta( 'id_service_pa_yclients', $order_info->therapist_cart );
				$duration = 10800;
			}			
			elseif ($order_info->type_cart=="Психосоматика2") {
				$service = get_the_author_meta( 'id_service_psy_yclients', $order_info->therapist_cart );
				$duration = 10800;
			}
			$sum_cart_fin=$order_info->first_cost;
			$sum_client_fin=$order_info->sum_cart;
			$discount_fin=$sum_cart_fin-$sum_client_fin;
			$services = [
				"id" => $service,
				"first_cost" => $order_info->first_cost,
				"discount"=> $discount_fin,
				"cost"=> $order_info->sum_cart,
			];
			
			$custom_fields=[
				'partner'=>$order_info->partner_client,
				"promocode"=>$order_info->promocode_client,
				"fact_sum"=>$order_info->sum_cart,
				"source"=>$order_info->domen,
			];
			
			$yclient_id = get_the_author_meta( 'id_yclients', $order_info->therapist_cart );
			$post = $yclients->postRecords($companyId, $token, $yclient_id,[$services], $custom_fields, $client, $y_date, $duration, true, false);
			
			//Если успешно, то записываем ID сделки
			if ($post['success']=="true")
			{
					//Обновляем статус в календаре терапевта
					$wpdb->update( 'wp_olly_cart',
					array( 'id_yclient' =>$post['data']['id'] ),
					array('id_cart'=>$cart)
				);				
			} else {
				$string = serialize($post); 
				$message_telegram = "Ошибка проброса в yclients!\r\n".$string;
				sendTelegram($chat_id, $message_telegram);				
			}
			
			//Если есть код партнера, то добавляем клиента этому партнеру
			if (isset($order_info->partner_client))
			{
				addClientPartner($order_info->partner_client, $order_info->email_client, $order_info->phone_client);	
			}
      
			// Уведомление в ТГ ТО
       
			$message_telegram = "1. Пользователь СМОГ оплатить.\r\n
			Тип : ".$order_info->packages."\r\n
			Имя клиента: ".$order_info->name_client."\r\n
			Фамилия клиента: ".$order_info->surname_client."\r\n
			Телефон клиента: ".$order_info->phone_client."\r\n
			Дата терапии: ". $date_ru." ".$time_ru."\r\n
			Промокод: ".$order_info->promocode_client."\r\n
			Сумма: ".$order_info->sum_client."\r\n
			Терапевт: ".$therapist_name.
			"\r\n Домен: ".$order_info->domen;
			
			sendTelegram($chat_id, $message_telegram);
			//sendTelegramSZ($message_telegram);
						
						
		} 
		
		#ОШИБКА ПЛАТЕЖА
		#---------------------------------------------------------------------------
		elseif ($status==="canceled") {
		
			//Обновляем статус в календаре терапевта
			$update_booking = $wpdb->update( 'wp_olly_cart',
				array( 'status_cart' => 'Свободно'),
				array('id_cart'=>$cart)
			);

			//Бот менеджера

			$message_telegram = "Пользователь не смог оплатить.\r\n
			Тип терапии: ".$order_info->type."\r\n
			Имя клиента: ".$order_info->name_client."\r\n 
			Фамилия клиента: ".$order_info->surname_client."\r\n 
			Телефон клиента: ".$order_info->phone_client."\r\n 
			Дата терапии: ". $date_ru." ".$time_ru."\r\n
			Терапевт: ".$therapist_name.
			"\r\n Домен: ".$order_info->domen;
			
			sendTelegram($chat_id, $message_telegram);
			sendTelegramSZ($message_telegram);
		}
		
		
	} 
	else
	{
		//Получаем информацию о заказе
		$sql = $wpdb->prepare( "SELECT wp_olly_booking.*, wp_olly_orders.* 
			FROM wp_olly_booking, wp_olly_orders 
			WHERE wp_olly_orders.id=%d
			AND wp_olly_booking.id_booking = wp_olly_orders.booking_id", $order );
			
	    $order_info = $wpdb->get_row($sql);
	    
	    //Приводим даты в удобночитаемый вид
	    $date_ru = ruDate($order_info->date_event,false);
	    $time_ru = ruDate($order_info->date_event,true);
	    //Для амо
	    $date_amo = date_format(date_create($order_info->date_event), 'd.m.Y H:i');
	    
	    //Получаем информацию о терапевте
	    $therapist = get_user_by('id', $order_info->therapist);
	    $therapist_name = $therapist->display_name;
	    $therapist_email = $therapist->user_email;
	    $therapist_phone = get_the_author_meta( 'phone', $order_info->therapist );
	    $therapist_tg= get_the_author_meta( 'bot', $order_info->therapist );
		
		
		#УСПЕХ
		#---------------------------------------------------------------------------
		if ($status==="succeeded")
		{
			
			//Обновляем статус в календаре терапевта
			//--------------
			
			$update_booking = $wpdb->update( 'wp_olly_booking',
				array( 'status' => 'Забронировано'),
				array('id_booking'=>$order_info->booking_id)
			);
			
			
			//В ТЕЛЕГРАМ ПСИХОЛОГУ
			//--------------

			
			$message_telegram = "Новая заявка!\r\n Имя клиента: ".$order_info->name_client.
			"\r\n Фамилия клиента: ".$order_info->surname_client.
			"\r\n Дата рождения: ".$order_info->birthday_client.
			"\r\n Телефон клиента: ".$order_info->phone_client.
			"\r\n Почта клиента: ".$order_info->email_client.
			"\r\n Дата терапии: ". $date_ru." ".$time_ru.
			"\r\n Запрос: ".$order_info->query_client.
			"\r\n Промокод: ".$order_info->promocode_client.
			"\r\n Сумма: ".$order_info->sum_client.
			"\r\n Тип терапии: ".$order_info->type;
			
			sendTelegram($therapist_tg, $message_telegram);

			//ПИСЬМО ПСИХОЛОГУ
			//--------------
			
			$html='<p><span style="font-size: 16px;">Добрый день!</span><br>
					<span style="font-size: 16px;">У вас новая запись на терапию</span></p>
					<p><span style="font-size: 16px;">Дата терапии: '.$date_ru." ".$time_ru.'</span></p>
					<p><span style="font-size: 16px;">Данные клиента:</span></p>
					<p><span style="font-size: 16px;">Фио: '.$order_info->name_client.' '.$order_info->surname_client.'</span></p>
					<p><span style="font-size: 16px;">Дата рождения: '.$order_info->birthday_client.'</span></p>
					<p><span style="font-size: 16px;">Почта: '.$order_info->email_client.'</span></p>
					<p><span style="font-size: 16px;">Телефон: '.$order_info->phone_client.'</span></p>
					<p><span style="font-size: 16px;">Промокод: '.$order_info->promocode_client.'</span></p>
					<p><span style="font-size: 16px;">Сумма: '.$order_info->sum_client.'</span></p>
					<p><span style="font-size: 16px;">Тип терапии: '.$order_info->type.'</span></p>';
			
			$emails = array(
			    'html' => $html,
			    'subject' => '[ollyteam] У вас новая запись на терапию',
			    'from' => array(
			        'name' => 'Ольга Роменская',
			        'email' => 'info@ollyrussia.ru',
			    ),
			    'to' => array(
			        array(
			            'name' => $therapist_name,
			            'email' => $therapist_email,
			        ),
			    )
			);
		
			$SPApiClient->smtpSendMail($emails);
			
			//СМС КЛИЕНТУ
			$sms_message = "Добрый день! Вы записаны на терапию на ".$date_ru." ".$time_ru." Ваш терапевт: ".$therapist_name;
			send_sms($sms_message,$order_info->phone_client);
			
			//ПИСЬМО КЛИЕНТУ
			//--------------
			$html='<p><span style="font-size: 16px;">Здравствуйте!</span><br>
					<span style="font-size: 16px;">Ваша запись к психологу подтверждена.</span></p>
					<p><span style="font-size: 16px;">Ваш психолог: '.$therapist_name.'</span></p>
					<p><span style="font-size: 16px;">Телефон психолога: '.$therapist_phone.'</span></p>
					<p><span style="font-size: 16px;">Дата и время сессии (время указано по Москве): '.$date_ru." ".$time_ru.'</span></p>
					<p><span style="font-size: 16px;">Обратите внимание, что вам может перезвонить или написать менеджер для уточнения деталей.</span></p>
					<p><span style="font-size: 16px;">Обязательно ознакомьтесь с <a href="https://ollyteam.ru/rules/">правилами проведения консультации</a> </span></p>
					<p><span style="font-size: 16px;">С уважением, команда Ольги Роменской.</span></p>';
			
			$emails = array(
			    'html' => $html,
			    'subject' => '[ollyteam] Вы успешно записаны на терапию',
			    'from' => array(
			        'name' => 'Ольга Роменская',
			        'email' => 'info@ollyrussia.ru',
			    ),
			    'to' => array(
			        array(
			            'name' => $order_info->name_client,
			            'email' => $order_info->email_client,
			        ),
			    )
			);
	
	
			$SPApiClient->smtpSendMail($emails);
			
			#Отправляем в уклиент
			
			$client = [
				"phone"=>$order_info->phone_client,
				"email"=>$order_info->email_client,
				"name"=>$order_info->surname_client." ".$order_info->name_client,
			];
			$datetime = new DateTime($order_info->date_event);
			$y_date = $datetime->format(DateTime::ATOM);
			
			if ($order_info->type=="Основа") {
				$service = get_the_author_meta( 'id_service_base_yclients', $order_info->therapist );
				$duration = 3600;
			}
			else {
				$service = get_the_author_meta( 'id_service_psy_yclients', $order_info->therapist );
				$duration = 10800;
			}
			
			$sum_cart_fin=$order_info->first_cost;
			$sum_client_fin=$order_info->sum_client;
			$discount_fin=$sum_cart_fin-$sum_client_fin;
			
			$services = [
				"id" => $service,
				"first_cost" => $order_info->first_cost,
				"discount"=> $discount_fin,
				"cost"=> $order_info->sum_client,
			];
			
			$custom_fields=[
				'partner'=>$order_info->partner_client,
				"promocode"=>$order_info->promocode_client,
				"fact_sum"=>$order_info->sum_client,
				"source"=>$order_info->domen,
			];
			
			$yclient_id = get_the_author_meta( 'id_yclients', $order_info->therapist );
			$post = $yclients->postRecords($companyId, $token, $yclient_id,[$services],$custom_fields, $client, $y_date, $duration, true, false);
			
			//Если успешно, то записываем ID сделки
			if ($post['success']=="true")
			{
					//Обновляем статус в календаре терапевта
				$wpdb->update( 'wp_olly_orders',
					array( 'id_yclient' =>$post['data']['id'] ),
					array('id'=>$order)
				);				
			} else {
				$string = serialize($post); 
				$message_telegram = "Ошибка проброса в yclients!\r\n".$string;
				sendTelegram($chat_id, $message_telegram);				
			}
			
			$message_telegram = "2. Пользователь СМОГ оплатить.\r\n
			Тип : ".$order_info->type."\r\n
			Имя клиента: ".$order_info->name_client."\r\n
			Фамилия клиента: ".$order_info->surname_client."\r\n
			Телефон клиента: ".$order_info->phone_client."\r\n
			Дата терапии: ". $date_ru." ".$time_ru."\r\n
			Промокод: ".$order_info->promocode_client."\r\n
			Сумма: ".$order_info->sum_client."\r\n
			Терапевт: ".$therapist_name.
			"\r\n Домен: ".$order_info->domen;
			
			sendTelegram($chat_id, $message_telegram);
			//sendTelegramSZ($message_telegram);
					
			//$lead = $amocrm->create_lead($lead_config);	
			//Если есть код партнера, то добавляем клиента этому партнеру
			/*if (!empty($order_info->partner_client))
			{
				addClientPartner($order_info->partner_client, $order_info->email_client, $order_info->phone_client);	
			}*/
			

		} 
		
		#ОШИБКА ПЛАТЕЖА
		#---------------------------------------------------------------------------
		elseif ($status==="canceled") {
		
			//Обновляем статус в календаре терапевта
			$update_booking = $wpdb->update( 'wp_olly_booking',
				array( 'status' => 'Свободно'),
				array('id_booking'=>$order_info->booking_id)
			);
			//Удаляем предварительную запись
			$delete = $wpdb->delete( 'wp_olly_orders', [ 'ID'=>$order ], [ '%d' ] );
			
			//Бот менеджера

			$message_telegram = "Пользователь не смог оплатить.\r\n
			Тип терапии: ".$order_info->type."\r\n
			Имя клиента: ".$order_info->name_client."\r\n 
			Фамилия клиента: ".$order_info->surname_client."\r\n 
			Телефон клиента: ".$order_info->phone_client."\r\n 
			Дата терапии: ". $date_ru." ".$time_ru."\r\n
			Промокод: ".$order_info->promocode_client."\r\n
			Сумма: ".$order_info->sum_client."\r\n 
			Терапевт: ".$therapist_name.
			"\r\n Домен: ".$order_info->domen;
			
			sendTelegram($chat_id, $message_telegram);
			sendTelegramSZ($message_telegram);
		
	
			
		}
		
	}
	
	