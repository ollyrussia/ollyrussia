<?php
/*
 * Template name: Прием коллбэка от уклиента
 * Template post type: page
 */
 

 	if (empty($wp_filesystem)) {
	            require_once (ABSPATH . '/wp-admin/includes/file.php');
	            WP_Filesystem();
	        }
	        
	$content_raw =  $wp_filesystem->get_contents('php://input');
	$content = json_decode($content_raw,true);
		
	
	if ($content['resource']=="record")
	{
		//Создали дату в уклиенте
		if ($content['status']=="create"){
			
			if ($content['data']['staff_id'] && $content['data']['date']){
				
				$user_id = getIdUser($content['data']['staff_id']);
				
				if (!empty($user_id)){
					
					$sql = $wpdb->prepare( "SELECT * FROM wp_olly_booking WHERE therapist = %d AND date_event=%s", $user_id, $content['data']['date'] );
					$result = $wpdb->get_row($sql);
					
					if ($wpdb->num_rows>0) {wp_die();}
					
					$service_id = getTypeService($content['data']['services'][0]['id']);
					
					if (!empty($content['data']['client']['name']) && !empty($content['data']['client']['phone']) &&!empty($content['data']['client']['email'])){
						$status = "Забронировано";
					} else {
						$status="Свободно";
					}

					$insert = $wpdb->insert( 'wp_olly_booking',
							array( 'therapist' => $user_id, 'date_event' => $content['data']['date'], 
									'status'=>$status, 'type'=>$service_id, 'yclients_id'=>$content['resource_id'] )
						);	
				}	
			}	
		}
		
		//Удалили дату в уклиенте
		if ($content['status']=="delete"){
			if ($content['resource_id']){											
					$delete_booking = $wpdb->delete( 'wp_olly_booking', [ 'yclients_id'=>$content['resource_id']]);	
				}	
		}	

		
		//Обновили дату в Уклиенте
		
		if ($content['status']=="update"){
			
			if ($content['resource_id']){
				
				$service_id = getTypeService($content['data']['services'][0]['id']);
				
				if (!empty($content['data']['client']['name']) && !empty($content['data']['client']['phone']) &&!empty($content['data']['client']['email'])){
					$status = "Забронировано";
				} else {
					$status="Свободно";
				}				
				
				$wpdb->update( 'wp_olly_booking',
					[ 'date_event' => $content['data']['date'], 'type' => $service_id, 'status'=>$status],
					[ 'yclients_id' => $content['resource_id']  ]
				);
				
			}	
		}		
		
	}
 