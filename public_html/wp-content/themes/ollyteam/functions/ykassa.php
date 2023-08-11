<?php

	require __DIR__ . '/libs/lib/autoload.php'; 
	use YooKassa\Client;
	
	add_action('admin_post_nopriv_setPayment', 'setPayment');
	add_action('admin_post_setPayment', 'setPayment');
	
	function setPayment(){
		
		global $wpdb;
		
		$client = new Client(); 
		$client->setAuth('721336', 'live_AVR-2CRJfyfPOvwnsJXZwJacLJGM0HKlpPzpgMAsir8');

		
		$status = $wpdb->get_var($wpdb->prepare("SELECT status FROM wp_olly_booking WHERE id_booking=%s", $_POST['booking_id']));
		
		
		$phone = clearPhone($_POST['phone_client']);
		
		if (	$status!="Свободно"	 || $phone=="79687520420" ) {
			wp_redirect("https://new.ollyteam.ru/reserv/");
			die();
		}
		
		//Обновляем статус в календаре терапевта
		$update = $wpdb->update( 'wp_olly_booking',
			array( 'status' => 'В процессе оплаты'),
			array('id_booking'=>$_POST['booking_id'],)
		);
		
		//Добавляем данные заказа
		$insert = $wpdb->insert(
			'wp_olly_orders',
			array(  
					'booking_id' => $_POST['booking_id'], 
					'date_order' => date("Y-m-d H:i:s"),
					'name_client' =>$_POST['name_client'],
					'surname_client' =>$_POST['surname_client'],
					'phone_client'=>$phone,
					'email_client'=>$_POST['email_client'],
					'query_client'=>$_POST['query_client'],
					'birthday_client' => $_POST['birthday_client'],
					'promocode_client' => $_POST['promocode_client'],
					'sum_client'=>$_POST['sum_client'],
					'partner_client'=>$_POST['partner'],
					'first_cost'=>$_POST['therapist_price'],
					'domen'=>$_SERVER['HTTP_HOST'],
					)
		
			);
		
		//Обновляем статус в календаре терапевта
		$update = $wpdb->update( 'wp_olly_booking',
			array( 'status' => 'В процессе оплаты'),
			array('id_booking'=>$_POST['booking_id'],)
		);
		
			
		
		//Переходим к оплате
		//--------------------------------------------------------------------
		$idempotenceKey = uniqid('', true);
		$response = $client->createPayment(
		    array(
		        'amount' => array(
		            'value' => $_POST['sum_client'],
		            'currency' => 'RUB',
		        ),
		        'confirmation' => array(
		            'type' => 'redirect',
		            'return_url' => 'https://ollyteam.ru/return/',
		        ),
		        'description' => 'Заказ #'.$wpdb->insert_id.' для '.$_POST['email_client'].','.$phone,
		        'metadata'=> array(
		          'order' =>$wpdb->insert_id,
		        ),
		        'capture'=>true,
		        "receipt" => array(
		            "customer" => array(
		                "full_name" => $_POST['name_client']." ".$_POST['surname_client'],
		                "email" => $_POST['email_client'],
		            ),
		            "items" => array(
		                array(
		                    "description" => "Оплата психологической терапии",
		                    "quantity" => "1.00",
		                    "amount" => array(
		                        "value" => $_POST['sum_client'],
		                        "currency" => "RUB"
		                    ),
		                    "vat_code" => "2",
		                    "payment_mode" => "full_prepayment",
		                    "payment_subject" => "service"
		                ),
		            )
		        )
		    ),
		    $idempotenceKey
		);
		
		$confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
		SetCookie("pid",$response['_id'],time()+172800,"/");
		wp_redirect( $confirmationUrl ); 
		exit;
		
	}
	
	
	//Оплата для корзины
	add_action('admin_post_nopriv_setPaymentCart', 'setPaymentCart');
	add_action('admin_post_setPaymentCart', 'setPaymentCart');
	
	function setPaymentCart(){
		
		global $wpdb;
		
		$client = new Client(); 
		$client->setAuth('721336', 'live_AVR-2CRJfyfPOvwnsJXZwJacLJGM0HKlpPzpgMAsir8');
		
		$status = $wpdb->get_var($wpdb->prepare("SELECT status_cart FROM wp_olly_cart WHERE id_cart= %s", $_POST['cart_id']));
		
		if ($status!="Свободно") {
			wp_redirect("https://new.ollyteam.ru/reserv/");
			die();
		}
		
		//Обновляем статус в корзине
		$update = $wpdb->update( 'wp_olly_cart',
			array( 'status_cart' => 'В процессе оплаты'),
			array('id_cart'=>$_POST['cart_id'],)
		);
		
		//Добавляем данные заказа
		$phone = clearPhone($_POST['phone_client']);
		$update  = $wpdb->update(
			'wp_olly_cart',
			array(  
					'date_order_client' => date("Y-m-d H:i:s"),
					'name_client' =>$_POST['name_client'],
					'surname_client' =>$_POST['surname_client'],
					'phone_client'=>$phone,
					'email_client'=>$_POST['email_client'],
					'query_client'=>$_POST['query_client'],
					'birthday_client' => $_POST['birthday_client'],
					'sum_cart'=>$_POST['sum_client'],
					'type_cart'=>$_POST['type_cart'],
					'promocode_client' => $_POST['promocode_client'],
					'first_cost'=>$_POST['therapist_price'],
					'domen'=>$_SERVER['HTTP_HOST'],
				),
			array('id_cart'=>$_POST['cart_id'],)
		
			);
		
		//Переходим к оплате
		//--------------------------------------------------------------------
		$idempotenceKey = uniqid('', true);
		$response = $client->createPayment(
		    array(
		        'amount' => array(
		            'value' => $_POST['sum_client'],
		            'currency' => 'RUB',
		        ),
		        'confirmation' => array(
		            'type' => 'redirect',
		            'return_url' => 'https://ollyteam.ru/return/',
		        ),
		        'description' => 'Заказ #K'.$_POST['cart_id'].' для '.$_POST['email_client'].','.$phone,
		        'metadata'=> array(
		          'cart'=>$_POST['cart_id'],
		        ),
		        'capture'=>true,
		        "receipt" => array(
		            "customer" => array(
		                "full_name" => $_POST['name_client']." ".$_POST['surname_client'],
		                "phone" => $phone,
		            ),
		            "items" => array(
		                array(
		                    "description" => "Оплата психологической терапии",
		                    "quantity" => "1.00",
		                    "amount" => array(
		                        "value" => $_POST['sum_client'],
		                        "currency" => "RUB"
		                    ),
		                    "vat_code" => "2",
		                    "payment_mode" => "full_prepayment",
		                    "payment_subject" => "service"
		                ),
		            )
		        )
		    ),
		    $idempotenceKey
		);
		
		$confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
		SetCookie("pid",$response['_id'],time()+172800,"/");
		wp_redirect( $confirmationUrl ); 
		exit;
		
	}
	
	add_action('admin_post_nopriv_setPaymentPackages', 'setPaymentPackages');
	add_action('admin_post_setPaymentPackages', 'setPaymentPackages');	
	function setPaymentPackages(){
		
		global $wpdb;
		
		$client = new Client(); 
		$client->setAuth('721336', 'live_AVR-2CRJfyfPOvwnsJXZwJacLJGM0HKlpPzpgMAsir8');
		
		$phone = clearPhone($_POST['phone_client']);
				
		//Добавляем данные заказа
		$insert = $wpdb->insert(
			'wp_olly_packages',
			array(  
					'packages' => $_POST['packages_name'], 
					'name_client' =>$_POST['name_client'],
					'surname_client' =>$_POST['surname_client'],
					'phone_client'=>$phone,
					'email_client'=>$_POST['email_client'],
					'therapist'=>$_POST['therapist'],
					'summa'=>$_POST['packages_summa'],
					'status'=>'В процессе оплаты',
					'domen'=>$_SERVER['HTTP_HOST'],
					)
		
			);
			
		//Переходим к оплате
		//--------------------------------------------------------------------
		$idempotenceKey = uniqid('', true);
		$response = $client->createPayment(
		    array(
		        'amount' => array(
		            'value' => $_POST['packages_summa'],
		            'currency' => 'RUB',
		        ),
		        'confirmation' => array(
		            'type' => 'redirect',
		            'return_url' => 'https://ollyteam.ru/return/',
		        ),
		        'description' => 'Заказ пакета #P'.$wpdb->insert_id.' для '.$_POST['email_client'].','.$phone,
		        'metadata'=> array(
		          'packages' =>$wpdb->insert_id,
		        ),
		        'capture'=>true,
		        "receipt" => array(
		            "customer" => array(
		                "full_name" => $_POST['name_client']." ".$_POST['surname_client'],
		                "email" => $_POST['email_client'],
		            ),
		            "items" => array(
		                array(
		                    "description" => "Оплата пакета психологической терапии",
		                    "quantity" => "1.00",
		                    "amount" => array(
		                        "value" => $_POST['packages_summa'],
		                        "currency" => "RUB"
		                    ),
		                    "vat_code" => "2",
		                    "payment_mode" => "full_prepayment",
		                    "payment_subject" => "service"
		                ),
		            )
		        )
		    ),
		    $idempotenceKey
		);
		
		$confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
		SetCookie("pid",$response['_id'],time()+172800,"/");
		wp_redirect( $confirmationUrl ); 
		exit;
		
	}	