<?
	error_reporting(E_ALL);
	ini_set('display_errors', 0);
	ini_set('log_errors','on');
	ini_set('error_log', __DIR__ . '/logs/main_error.log');
	
	define('SHORTINIT', true);
	require('../wp-load.php');
	global $wpdb;
	

	//--------------------------------------------------------------------------
	
	require __DIR__ . '/sendpulse/ApiInterface.php';
	require __DIR__ . '/sendpulse/ApiClient.php';
	require __DIR__ . '/sendpulse/Storage/TokenStorageInterface.php';
	require __DIR__ . '/sendpulse/Storage/FileStorage.php';
	require __DIR__ . '/sendpulse/Storage/SessionStorage.php';
	require __DIR__ . '/sendpulse/Storage/MemcachedStorage.php';
	require __DIR__ . '/sendpulse/Storage/MemcacheStorage.php';
	
	define('API_USER_ID', '770db57e618ab06505042fa780074cf3');
	define('API_SECRET', 'dd0215093ffb175ddf3c7b1f8729bfcb');
	define('PATH_TO_ATTACH_FILE', __FILE__);
	
	use Sendpulse\RestApi\ApiClient;
	use Sendpulse\RestApi\Storage\FileStorage;
	
	$SPApiClient = new ApiClient(API_USER_ID, API_SECRET, new FileStorage());
	
	//Подлючаем телеграм
	//--------------------------------------------------------------------------	
	require __DIR__ . '/telegram/Telegram.php';
	
	$telegram = new Telegram('1098240823:AAGj90cUWk1wawGWx-645Iy6Nn7Qhkd0DHo');
	
	//--------------------------------------------------------------------------
	
	$monthes = array(
    '01' => 'Января', '02' => 'Февраля', '03' => 'Марта', '04' => 'Апреля',
    '05' => 'Мая', '06' => 'Июня', '07' => 'Июля', '08' => 'Августа',
    '09' => 'Сентября', '10' => 'Октября', '11' => 'Ноября', '12' => 'Декабря'
	);
	
	//--------------------------------------------------------------------------
	
	$content = json_decode(file_get_contents('php://input'),true);
	
	$fd = fopen("hello.txt", 'w') or die("не удалось создать файл");
	fwrite($fd, $content);
	fclose($fd);
	
	$event = $content['event'];
	$status = $content['object']['status'];
	$therapist_id = $content['object']['metadata']['therapist'];
	$date = $content['object']['metadata']['date'];
	$id_row_order = $content['object']['metadata']['id_row_order'];
	$birthday = $content['object']['metadata']['birthday'];
	$onko = $content['object']['metadata']['onko'];
	$promocode = $content['object']['metadata']['promocode'];
	
	$psy_code = $content['object']['metadata']['psy_code'];
	
	
	//Проверяем на психосоматику
	if ($psy_code=='' && isset($psy_code))
	{
	
		if ($promocode==''){$promocode="Нет";}
		
		if ($onko==1){$onko_text="Да";} else {$onko_text="Нет";};
		
		
		$therapist = $wpdb->get_row( "SELECT * FROM `wp_ollyteam_therapist` WHERE id = $therapist_id");
		$order = $wpdb->get_row( "SELECT * FROM `wp_ollyteam_orders` WHERE id = $id_row_order");
		
		$day = date("d",strtotime($date));
		$month = $monthes[ date("m",strtotime($date)) ];
		$hour =  date('H:i',strtotime($date));
	  
		$sms_date = $day." ".$month." ".$hour;
			
		
		if ($status==="succeeded")
		{
			
			//Обновляем статус в календаре терапевта
			$update_booking = $wpdb->update( 'wp_ollyteam_booking',
			array( 'status' => 'Забронировано'),
			array('therapist'=>$therapist_id,'start_event'=>$date)
			);
			//Обновляем статус в заявках
			$update_orders = $wpdb->update( 'wp_ollyteam_orders',
			array( 'status' => 'Оплачено'),
			array('id'=>$id_row_order)
			);
			
	
			
	
			if ($update_booking>0 && $update_orders>0 )
			{
			
				//ОТПРАВКА ИНФОРМАЦИИ ТЕРАПЕВТУ
				
				//Телеграм
		
				$chat_id = $therapist->telegram;
				if ($chat_id!="")
				{
					$message_telegram = "Новая заявка!\r\n Имя клиента: ".$order->fio.
					"\r\n Фамилия клиента: ".$order->surname.
					"\r\n Дата рождения: ".$birthday.
					"\r\n Телефон клиента: ".$order->phone.
					"\r\n Почта клиента: ".$order->email.
					"\r\n Дата сессии: ". $sms_date.
					"\r\n Запрос: ".$order->query.
					"\r\n Промокод: ".$promocode.
					"\r\n Онко: ".$onko_text;
										 
					$content = array('chat_id' => $chat_id, 'text' => $message_telegram);
					$telegram->sendMessage($content);
				}
			
				//СМС
				$additionalParams = array();
				$phones = array($therapist->phone);
				$params = array(
				    'sender' => 'ollyrussia',
				    'body' => "Новый клиент: ".$order->fio." / ".$order->phone." на ".$sms_date,
				    'transliterate' => 0,
				);
			
				$SPApiClient->sendSmsByList($phones,$params,$additionalParams);
	
			
				//Письмо
				$html='<p><span style="font-size: 16px;">Добрый день!</span><br>
						<span style="font-size: 16px;">У вас новая запись на терапию</span></p>
						<p><span style="font-size: 16px;">Дата терапии: '.$sms_date.'</span></p>
						<p><span style="font-size: 16px;">Данные клиента:</span></p>
						<p><span style="font-size: 16px;">Фио: '.$order->fio.' '.$order->surname.'</span></p>
						<p><span style="font-size: 16px;">Дата рождения: '.$birthday.'</span></p>
						<p><span style="font-size: 16px;">Почта: '.$order->email.'</span></p>
						<p><span style="font-size: 16px;">Телефон: '.$order->phone.'</span></p>';
				
				$emails = array(
				    'html' => $html,
				    'subject' => '[ollyrussia] У вас новая запись на терапию',
				    'from' => array(
				        'name' => 'Ольга Роменская',
				        'email' => 'info@ollyrussia.ru',
				    ),
				    'to' => array(
				        array(
				            'name' => $therapist->name,
				            'email' => $therapist->email,
				        ),
				    )
				);
			
			$SPApiClient->smtpSendMail($emails);
			
			//ОТПРАВКА ИНФОРМАЦИИ ПОЛЬЗОВАТЕЛЮ
			
			//Ждем 10 секунд
			sleep(10);
			
			//СМС
			$additionalParams = array();
			$phones = array($order->phone);
			$params = array(
			    'sender' => 'ollyrussia',
			    'body' => "Добрый день! Вы записаны на терапию на ".$sms_date." Ваш терапевт: ".$therapist->name,
			    'transliterate' => 0,
			);
			
			$SPApiClient->sendSmsByList($phones,$params,$additionalParams);
			
	
	
	
	
			//Письмо
			$html='<p><span style="font-size: 16px;">Здравствуйте!</span><br>
					<span style="font-size: 16px;">Ваша запись к психологу подтверждена.</span></p>
					<p><span style="font-size: 16px;">Ваш психолог: '.$therapist->name.'</span></p>
					<p><span style="font-size: 16px;">Телефон психолога: '.$therapist->phone.'</span></p>
					<p><span style="font-size: 16px;">Дата и время сессии (время указано по Москве): '.$sms_date.'</span></p>
					<p><span style="font-size: 16px;">Обратите внимание, что вам может перезвонить или написать менеджер для уточнения деталей.</span></p>
					<p><span style="font-size: 16px;">Обязательно ознакомьтесь с <a href="https://ollyteam.ru/?page_id=115">правилами проведения консультации</a> </span></p>
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
			            'name' => $order->name,
			            'email' => $order->email,
			        ),
			    )
			);
	
	
			$SPApiClient->smtpSendMail($emails);
		
			}
			
		} elseif ($status==="canceled")
		{
			//Обновляем статус в календаре терапевта
			$update_booking = $wpdb->update( 'wp_ollyteam_booking',
			array( 'status' => 'Свободно'),
			array('therapist'=>$therapist_id,'start_event'=>$date)
			);
			//Обновляем статус в заявках
			$update_orders = $wpdb->update( 'wp_ollyteam_orders',
			array( 'status' => 'Ошибка при оплате'),
			array('id'=>$id_row_order)
			);
			
			if ($onko==1)
			{
						$iteration = $wpdb->query(" UPDATE `wp_ollyteam_therapist` 
									  SET `onko_counter` = `onko_counter` - 1
									  WHERE id='$therapist_id' ");
			}
			
				//Уведомление Яне в телеграм об ошибке оплаты
		
				$chat_id = 517214093;
				if ($chat_id!="")
				{
					$message_telegram = "Пользователь не смог оплатить.\r\n Имя клиента: ".$order->fio."\r\n Фамилия клиента: ".$order->surname."\r\n Дата рождения: ".$birthday."\r\n Телефон клиента: ".$order->phone."\r\n Дата сессии: ". $sms_date."\r\n Запрос: ".$order->query."\r\n Терапевт: ".$therapist->name;
										 
					$content = array('chat_id' => $chat_id, 'text' => $message_telegram);
					$telegram->sendMessage($content);
				}		
			
			
		}
	}
	else
	{
		$mydb = new wpdb('cf78864_psy','cf78864_psy','cf78864_psy','localhost');
		$therapist = $mydb->get_row( "SELECT * FROM `wp_ollyteam_therapist` WHERE id = $therapist_id");
		$order = $mydb->get_row( "SELECT * FROM `wp_ollyteam_orders` WHERE id = $id_row_order");
		
		$day = date("d",strtotime($date));
		$month = $monthes[ date("m",strtotime($date)) ];
		$hour =  date('H:i',strtotime($date));
	  
		$sms_date = $day." ".$month." ".$hour;
			
		
		if ($status==="succeeded")
		{
			
			
			//Обновляем статус в календаре терапевта
			$update_booking = $mydb->update( 'wp_ollyteam_booking',
			array( 'status' => 'Забронировано'),
			array('therapist'=>$therapist_id,'start_event'=>$date)
			);
			//Обновляем статус в заявках
			$update_orders = $mydb->update( 'wp_ollyteam_orders',
			array( 'status' => 'Оплачено'),
			array('id'=>$id_row_order)
			);
			//Обновляем статус в кодах доступа
			$update_access = $mydb->update( 'wp_psy_access',
			array( 'status' => '1'),
			array('code'=>$psy_code)
			);
			
	
			
	
			if ($update_booking>0 && $update_orders>0 )
			{
			
				//ОТПРАВКА ИНФОРМАЦИИ ТЕРАПЕВТУ
				
				//Телеграм
		
				$chat_id = $therapist->telegram;
				if ($chat_id!="")
				{
					$message_telegram = "Новая заявка по ПСИХОСОМАТИКЕ!\r\n Имя клиента: ".$order->fio.
					"\r\n Фамилия клиента: ".$order->surname.
					"\r\n Дата рождения: ".$birthday.
					"\r\n Телефон клиента: ".$order->phone.
					"\r\n Почта клиента: ".$order->email.
					"\r\n Дата сессии: ". $sms_date.
					"\r\n Запрос: ".$order->query;
	
					$content = array('chat_id' => $chat_id, 'text' => $message_telegram);
					$telegram->sendMessage($content);
				}
			
				//СМС
				$additionalParams = array();
				$phones = array($therapist->phone);
				$params = array(
				    'sender' => 'ollyrussia',
				    'body' => "Новый клиент: ".$order->fio." / ".$order->phone." на ".$sms_date,
				    'transliterate' => 0,
				);
			
				$SPApiClient->sendSmsByList($phones,$params,$additionalParams);
	
			
				//Письмо
				$html='<p><span style="font-size: 16px;">Добрый день!</span><br>
						<span style="font-size: 16px;">У вас новая запись на ПСИХОСОМАТИКУ</span></p>
						<p><span style="font-size: 16px;">Дата терапии: '.$sms_date.'</span></p>
						<p><span style="font-size: 16px;">Данные клиента:</span></p>
						<p><span style="font-size: 16px;">Фио: '.$order->fio.' '.$order->surname.'</span></p>
						<p><span style="font-size: 16px;">Дата рождения: '.$birthday.'</span></p>
						<p><span style="font-size: 16px;">Почта: '.$order->email.'</span></p>
						<p><span style="font-size: 16px;">Телефон: '.$order->phone.'</span></p>';
				
				$emails = array(
				    'html' => $html,
				    'subject' => '[ollyrussia] У вас новая запись на терапию',
				    'from' => array(
				        'name' => 'Ольга Роменская',
				        'email' => 'info@ollyrussia.ru',
				    ),
				    'to' => array(
				        array(
				            'name' => $therapist->name,
				            'email' => $therapist->email,
				        ),
				    )
				);
			
			$SPApiClient->smtpSendMail($emails);
			
			//ОТПРАВКА ИНФОРМАЦИИ ПОЛЬЗОВАТЕЛЮ
			
			//Ждем 10 секунд
			sleep(10);
			
			//СМС
			$additionalParams = array();
			$phones = array($order->phone);
			$params = array(
			    'sender' => 'ollyrussia',
			    'body' => "Добрый день! Вы записаны на терапию на ".$sms_date." Ваш терапевт: ".$therapist->name,
			    'transliterate' => 0,
			);
			
			$SPApiClient->sendSmsByList($phones,$params,$additionalParams);
			
	
	
	
	
			//Письмо
			$html='<p><span style="font-size: 16px;">Здравствуйте!</span><br>
					<span style="font-size: 16px;">Ваша запись к психологу подтверждена.</span></p>
					<p><span style="font-size: 16px;">Ваш психолог: '.$therapist->name.'</span></p>
					<p><span style="font-size: 16px;">Телефон психолога: '.$therapist->phone.'</span></p>
					<p><span style="font-size: 16px;">Дата и время сессии (время указано по Москве): '.$sms_date.'</span></p>
					<p><span style="font-size: 16px;">Обратите внимание, что вам может перезвонить или написать менеджер для уточнения деталей.</span></p>
					<p><span style="font-size: 16px;">Обязательно ознакомьтесь с <a href="https://ollyteam.ru/?page_id=115">правилами проведения консультации</a> </span></p>
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
			            'name' => $order->name,
			            'email' => $order->email,
			        ),
			    )
			);
	
	
			$SPApiClient->smtpSendMail($emails);
		
			}
			
		} elseif ($status==="canceled")
		{
			//Обновляем статус в календаре терапевта
			$update_booking = $mydb->update( 'wp_ollyteam_booking',
			array( 'status' => 'Свободно'),
			array('therapist'=>$therapist_id,'start_event'=>$date)
			);
			//Обновляем статус в заявках
			$update_orders = $mydb->update( 'wp_ollyteam_orders',
			array( 'status' => 'Ошибка при оплате'),
			array('id'=>$id_row_order)
			);
					//Обновляем статус в кодах доступа
			$update_access = $mydb->update( 'wp_psy_access',
			array( 'status' => '0'),
			array('code'=>$psy_code)
			);
			
			if ($onko==1)
			{
						$iteration = $wpdb->query(" UPDATE `wp_ollyteam_therapist` 
									  SET `onko_counter` = `onko_counter` - 1
									  WHERE id='$therapist_id' ");
			}
			
				//Уведомление Яне в телеграм об ошибке оплаты
		
				$chat_id = 517214093; //Яна
				//$chat_id = 361093437;
				
				if ($chat_id!="")
				{
					$message_telegram = "Пользователь не смог оплатить.\r\n Имя клиента: ".$order->fio."\r\n Фамилия клиента: ".$order->surname."\r\n Дата рождения: ".$birthday."\r\n Телефон клиента: ".$order->phone."\r\n Дата сессии: ". $sms_date."\r\n Запрос: ".$order->query."\r\n Терапевт: ".$therapist->name;
										 
					$content = array('chat_id' => $chat_id, 'text' => $message_telegram);
					$telegram->sendMessage($content);
				}		
			
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	