<?
	#Функции для работы с расписанием
	
	//Добавление терапии
	add_action( 'wp_ajax_add_therapy', 'add_therapy' );
	add_action( 'wp_ajax_nopriv_add_therapy', 'add_therapy' );
	
	function add_therapy()
	{
		global $wpdb;
		
		$sql = $wpdb->prepare( "SELECT * FROM wp_olly_booking WHERE therapist = %d AND date_event=%s", $_POST['therapist'], $_POST['add_date'] );
    	$wpdb->get_results($sql);
    	
	    if ($wpdb->num_rows>0) {$return = "Такая дата и время уже есть.";}
	    else {
		
			$insert = $wpdb->insert( 'wp_olly_booking',
	    		array( 'therapist' => $_POST['therapist'], 'date_event' => $_POST['add_date'], 
	    				'status'=>'Свободно', 'type'=>$_POST['type'] )
			);
		
			if (	$insert != false	)	{	$return = "Терапия добавлена";	}
			else {$return =  "Ошибка добавления терапии!";}
	
			
	    }
	    
	    echo $return; 
	    wp_die();
	}
	


	//Получаем терапии от сегодняшнего дня +60 дней
	//Функция для фронта
	add_action( 'wp_ajax_getTherapyFront', 'getTherapyFront' );
	add_action( 'wp_ajax_nopriv_getTherapyFront', 'getTherapyFront' );
	function getTherapyFront()
	{
		global $wpdb;
		
		$id_therapist = $_POST['id_therapist'];
		$type = $_POST['type'];
		
		if (	$type=="Основа" )
		{

			$sql = "SELECT * FROM wp_olly_booking 
			WHERE therapist = %d
			AND type IN ('Психология/Психосоматика', 'Основа')
			AND status='Свободно' 
			AND date_event BETWEEN DATE_ADD(NOW(),INTERVAL 1 HOUR) AND DATE_ADD( NOW(), INTERVAL 150 DAY )
			ORDER BY date_event";
		} 
		
		if (	$type=="Психосоматика" )
		{
			$sql = "SELECT * FROM wp_olly_booking 
			WHERE therapist = %d
			AND type IN ('Психология/Психосоматика','Психосоматика2','Психосоматика')
			AND status='Свободно' 
			AND date_event BETWEEN DATE_ADD(NOW(),INTERVAL 1 HOUR) AND DATE_ADD( NOW(), INTERVAL 150 DAY )
			ORDER BY date_event";
		}
		
		if (	$type=="Насилие/ПА" )
		{
			$sql = "SELECT * FROM wp_olly_booking 
			WHERE therapist = %d
			AND type IN ('Насилие/ПА')
			AND status='Свободно' 
			AND date_event BETWEEN DATE_ADD(NOW(),INTERVAL 1 HOUR) AND DATE_ADD( NOW(), INTERVAL 150 DAY )
			ORDER BY date_event";
		}		
		
		$return_arr = array();
		
		$sql = $wpdb->prepare( $sql, $id_therapist);
    	$result = $wpdb->get_results($sql);
    	
    	
    	if ($wpdb->num_rows<1) { return false; wp_die();	}
        
        else {
        	
        	foreach($result as $row) {
        		

        		$date = ruDate($row->date_event,false);
        		$time = ruDate($row->date_event,true);
        		
				$return_arr[$date][$time]['booking_id']	= $row->id_booking;
        		$return_arr[$date][$time]['date']	= $date." ".$time;
        		$return_arr[$date][$time]['type']	= $row->type;
        		
        	}
        	
        }
        	echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
			wp_die();
	}
        
	//Получаем терапии от сегодняшнего дня +60 дней
	//Функция для админки
	add_action( 'wp_ajax_getTherapy', 'getTherapy' );
	add_action( 'wp_ajax_nopriv_getTherapy', 'getTherapy' );
	
	function getTherapy()
	{
		global $wpdb;
		
		$id_therapist = $_POST['id_therapist'];
		$type = $_POST['type'];

		

		$sql = "SELECT wp_olly_booking.* ,wp_olly_orders.* 
				FROM wp_olly_booking LEFT JOIN wp_olly_orders ON wp_olly_booking.id_booking = wp_olly_orders.booking_id
				WHERE wp_olly_booking.therapist = %d 
				AND wp_olly_booking.type IN (%s)
				AND date_event BETWEEN NOW() AND DATE_ADD( NOW(), INTERVAL 150 DAY)
				ORDER BY date_event";
		
		
		
		$return_arr = array();
		
		$sql = $wpdb->prepare( $sql, $id_therapist, $type );
    	$result = $wpdb->get_results($sql);
    	
    	
    	if ($wpdb->num_rows=0) {$return ="Терапии не найдены.";	}
        
        else {
        	
        	foreach($result as $row) {
        		
        		$therapist = get_user_by('id', $row->therapist);
        		$name_therapist = $therapist->display_name;
        		
        		$price = get_the_author_meta('price',$therapist->ID);
        		
        		$date = ruDate($row->date_event,false);
        		$time = ruDate($row->date_event,true);
        		
        		$return_arr[$date][$time]['id'] = $row->id_booking;
        		$return_arr[$date][$time]['date']	= $date." ".$time;
        		$return_arr[$date][$time]['status']	= $row->status;
        		
    			if ($row->status!="Свободно")
    			{
	        		$return_arr[$date][$time]['info']['type']	= $row->type;
	        		$return_arr[$date][$time]['info']['fio']	= $row->name_client." ".$row->surname_client;
	        		$return_arr[$date][$time]['info']['phone']	= $row->phone_client;
	        		$return_arr[$date][$time]['info']['email']	= $row->email_client;
	        		$return_arr[$date][$time]['info']['query']	= $row->query_client;
	        		$return_arr[$date][$time]['info']['promocode']	= $row->promocode_client;
	        		$return_arr[$date][$time]['info']['sum']	= $row->sum_client;
	        		$return_arr[$date][$time]['info']['birthday']	= $row->birthday_client;        				
    			}
        		

        		
        	}
        	

			echo json_encode($return_arr,JSON_UNESCAPED_UNICODE);
			wp_die();
        	
        }    
    	
    	
	}
	
	add_action( 'wp_ajax_delTherapy', 'delTherapy' );
	add_action( 'wp_ajax_nopriv_delTherapy', 'delTherapy' );
	
	//Удаление терапии
	function delTherapy()
	{
		
		global $wpdb;
		
		$delete_booking = $wpdb->delete( 'wp_olly_booking', [ 'id_booking'=>$_POST['id'] ], [ '%d' ] );
		$delete_order = $wpdb->delete( 'wp_olly_orders', [ 'booking_id'=>$_POST['id'] ], [ '%d' ] );	

		if ($delete_booking!=0) {
			echo "Терапия успешно удалена. Если к ней была привязана карточка клиента - она также удалена.";
		} else { echo $wpdb->$last_error; echo "Ошибка удаления терапии. Попробуйте еще раз.";}
		wp_die();
		
	}
	
	//Вывод всех терапий по дате
	add_action( 'wp_ajax_getTherapyByDate', 'getTherapyByDate' );
	add_action( 'wp_ajax_nopriv_getTherapyByDate', 'getTherapyByDate' );
	
	function getTherapyByDate()
	{
		global $wpdb;
		
		$return_arr = array();
		$date = "%" . $_POST['date'] . "%";
		
		$type = $_POST['type'];
		
		if (	$type=="Основа" )
		{
			$sql = "SELECT * 
					FROM wp_olly_booking 
					WHERE type IN ('Психология/Психосоматика','Основа')
	                AND wp_olly_booking.status='Свободно'
					AND wp_olly_booking.date_event LIKE %s
					AND date_event BETWEEN DATE_ADD(NOW(),INTERVAL 1 HOUR) AND DATE_ADD( NOW(), INTERVAL 150 DAY)
					";			
		}
		
		if (	$type=="Психосоматика" )
		{
			$sql = "SELECT * 
					FROM wp_olly_booking 
					WHERE type IN ('Психология/Психосоматика','Психосоматика','Психосоматика2')
	                AND wp_olly_booking.status='Свободно'
					AND wp_olly_booking.date_event LIKE %s
					AND date_event BETWEEN DATE_ADD(NOW(),INTERVAL 1 HOUR) AND DATE_ADD( NOW(), INTERVAL 150 DAY)
					";			
		}
		
		if (	$type=="Насилие/ПА" )
		{
			$sql = "SELECT * 
					FROM wp_olly_booking 
					WHERE type IN ('Насилие/ПА')
	                AND wp_olly_booking.status='Свободно'
					AND wp_olly_booking.date_event LIKE %s
					AND date_event BETWEEN DATE_ADD(NOW(),INTERVAL 1 HOUR) AND DATE_ADD( NOW(), INTERVAL 150 DAY)
					";			
		}		

		$sql = $wpdb->prepare( $sql,$date );
    	$result = $wpdb->get_results($sql);
    	
    	if ($wpdb->num_rows<1) {return false; wp_die();	}
    	
    	else {
        	$data = [];
        	$i=0;
        	foreach($result as $row) {
        		
        		$therapist = get_user_by('id', $row->therapist);
        		$name_therapist = $therapist->display_name;
        		$category = get_the_author_meta('category',$therapist->ID);
        		$url_name = get_the_author_meta('url_name',$therapist->ID);
        		$url = "https://ollyteam.ru/".$url_name;
        		
				if ($type=="Насилие/ПА"){
					$price=get_the_author_meta('price_violence',$therapist->ID);
				}
				else {
					$price = get_the_author_meta('price',$therapist->ID);
				}
        		
        		
        		$date = ruDate($row->date_event,false);
        		$time = ruDate($row->date_event,true);
        		
        	/*	$return_arr[$name_therapist][$date][$time]['id'] = $row->id_booking;
        		$return_arr[$name_therapist][$date][$time]['date']	= $date." ".$time;
        		$return_arr[$name_therapist][$date][$time]['time']	= $time;
        		$return_arr[$name_therapist][$date][$time]['type']	= $row->type;
        		$return_arr[$name_therapist][$date][$time]['therapist_id']	= $row->therapist;
        		$return_arr[$name_therapist][$date][$time]['therapist_name']	= $name_therapist;
        		$return_arr[$name_therapist][$date][$time]['price']	= $price;*/
        		
        		$data[] = [
        		
					'id_booking' => $row->id_booking,
					'date'=> $date,
					'time' => $time,
					'type' => $row->type,
					'therapist_id' => $row->therapist,
					'therapist_name' => $name_therapist,
					'category'=>$category,
					'price' => $price,
					'url' => $url,
					'type'=>$row->type,
					
				];
        
        	}
        	echo json_encode($data,JSON_UNESCAPED_UNICODE);
			wp_die();
    	}
        	


		
	}
	
	//Добавление корзины
	add_action( 'wp_ajax_addPrecart', 'addPrecart' );
	add_action( 'wp_ajax_nopriv_addPrecart', 'addPrecart' );
	
	function addPrecart()
	{
		global $wpdb;
		
		$insert = $wpdb->insert( 'wp_olly_cart',
	    	array( 'therapist_cart' => $_POST['therapist'], 'date_cart' => $_POST['date'], 
	    			'status_cart'=>'Свободно','type_cart'=>$_POST['type_cart'], 'sum_cart'=>$_POST['sum'], 'url_cart'=>uniqid() )
			);
			
		
		if (	$insert != false	)	{	$return = "Корзина добавлена";	}
		else {$return =  "Ошибка добавления корзины!";}
	
			
		echo $return;
	    
	    wp_die();
	}
	
	//Удаление корзины
	function delCart()
	{
		
		global $wpdb;
		
		$delete_cart = $wpdb->delete( 'wp_olly_cart', [ 'id_cart'=>$_POST['id'] ], [ '%d' ] );
	
		if ($delete_cart!=0) {
			echo "Терапия успешно удалена. Если к ней была привязана карточка клиента - она также удалена.";
		} else { echo $wpdb->$last_error; echo "Ошибка удаления терапии. Попробуйте еще раз.";}
		wp_die();
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
