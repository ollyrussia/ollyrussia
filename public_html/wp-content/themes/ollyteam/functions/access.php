<?
	//Добавляем коды доступа
	add_action( 'wp_ajax_add_access', 'add_access' ); 
	add_action( 'wp_ajax_nopriv_add_access', 'add_access' );
	
	function add_access()
	{
		global $wpdb;
	
		$phones = str_replace(' ', '', $_POST['phones']);
		$phones_array = explode(",", $phones);
		
		foreach ($phones_array as $phone) 
		{
			$result = $wpdb->insert('wp_olly_access',
		    	array( 
		    			'code' => wp_generate_password(17,false,false), 
		    			'phone' => clearPhone($phone),
		    			'status' =>0
		    			)
				);
		}
	
			
			if($result != false)
			{
				echo 'Коды добавлены';
			}
			
			else 
			{
				$wpdb->show_errors();
				echo  $wpdb->print_error();
			}
		
		die; 
	}
	
	add_action( 'wp_ajax_getAccessAll', 'getAccessAll' ); 
	add_action( 'wp_ajax_nopriv_getAccessAll', 'getAccessAll' );
	function getAccessAll()
	{
		global $wpdb;
		
		$return_arr = array();
		$access = $wpdb->get_results( "SELECT * FROM wp_olly_access ORDER BY id DESC ");

		if( $access ) {
			foreach ( $access as $ac ) 
			{
					$return_arr[$ac->id]['id'] = $ac->id;
	        		$return_arr[$ac->id]['phone']= $ac->phone;
	        		$return_arr[$ac->id]['code']	= "https://new.ollyteam.ru/psy/?code=".$ac->code;
	        		$return_arr[$ac->id]['status']	= $ac->status;
			}
		}
		
		echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
		wp_die();
	}