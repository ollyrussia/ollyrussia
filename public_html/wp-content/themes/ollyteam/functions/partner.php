<?
	#Функции для работы с партнерской программой
	
	//Добавление
	add_action( 'wp_ajax_addPartner', 'addPartner' );
	add_action( 'wp_ajax_nopriv_addPartner', 'addPartner' );
	
	function addPartner()
	{

		global $wpdb;
		$result = $wpdb->insert('wp_olly_partner',
	    	array( 
	    			'code' => $_POST['code'], 
	    			'description' => $_POST['description'],
	    			'date_created_partner' => date("Y-m-d H:i:s"),
	    		 )
		);
		
		if($result != false)
		{
			echo 'Партнер добавлен';
		}
			
		else 
		{
			$wpdb->show_errors();
			echo  $wpdb->print_error();
		}
		
		die; 

	}
	//Вывод партнеров
	add_action( 'wp_ajax_getPartners', 'getPartners' );
	add_action( 'wp_ajax_nopriv_getPartners', 'getPartners' );
	
	function getPartners()
	{
		/*
		SELECT wp_olly_partner.*, wp_olly_partner_clients.*, wp_olly_orders.* 
		FROM wp_olly_partner LEFT JOIN wp_olly_partner_clients ON wp_olly_partner_clients.code_partner = wp_olly_partner.id
		LEFT JOIN wp_olly_orders ON wp_olly_partner_clients.email_client_partner=wp_olly_orders.email_client
		WHERE wp_olly_orders.date_order > wp_olly_partner.date_created_partner
		*/
		global $wpdb;
		
		$return_arr = array();
		$partners = $wpdb->get_results( "SELECT * FROM wp_olly_partner ORDER BY id DESC ");

		if( $partners ) {
			foreach ( $partners as $partner ) 
			{
					$return_arr[$partner->id]['id'] = $partner->id;
	        		$return_arr[$partner->id]['code']= $partner->code;
	        		$return_arr[$partner->id]['description']= $partner->description;
	        		$return_arr[$partner->id]['url']	= "https://ollyteam.ru/?pp=".$partner->code;
			}
		}
		
		echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
		wp_die();
	}
	
	//Добавление клиента партнеру
	//Если клиента нет в базе партнеров, то добавляем его текущему партнеру
	function addClientPartner($code,$email,$phone)
	{
		global $wpdb;
		
		$sql = $wpdb->prepare( "SELECT * FROM wp_olly_partner_clients WHERE email_client_partner = %s AND phone_client_partner=%s", $email, $phone );
    	$wpdb->get_results($sql);
    	
	    if ($wpdb->num_rows<1) {
	    	
	    	$id_code = $wpdb->get_var($wpdb->prepare(
				"SELECT id FROM wp_olly_partner WHERE code = %s", $code
			));

			$insert = $wpdb->insert( 'wp_olly_partner_clients',
	    		array(  'code_partner' => $id_code, 
	    				'phone_client_partner' => $phone, 
	    				'email_client_partner'=>$email
	    			  )
			);
	    }
		

	
	}
