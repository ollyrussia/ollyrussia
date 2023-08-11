<?php

	#Функции для работы с бронированием дома
	
	//Бронирование дома
	add_action( 'wp_ajax_booking_home', 'booking_home' );
	add_action( 'wp_ajax_nopriv_booking_home', 'booking_home' );
	
	function booking_home()
	{
		global $wpdb;
		
		$sql = $wpdb->prepare( "SELECT * FROM wp_olly_home t WHERE type = %s AND %s between t.date_start and t.date_end or %s between t.date_start and t.date_end", $_POST['type'], $_POST['date_start'],$_POST['date_end'] );
    	$wpdb->get_results($sql);
    	
	    if ($wpdb->num_rows>0) {$return = $_POST['type']." уже забронирован на данную дату и время";}
	    else {
		
			$insert = $wpdb->insert( 'wp_olly_home',
	    		['information' => $_POST['info'], 
						'date_start' => $_POST['date_start'],
						'date_end' => $_POST['date_end'],
						'employee' => $_POST['employee'],
						'type' => $_POST['type'],
				]
			);
		
			if (	$insert != false	)	{	$return = $_POST['type']." забронирован";	}
			else {$return =  "Ошибка бронирования. Обратитесь к программисту, если ошибка повторяется.";}
			
	    }
		
	    echo $return; 
	    wp_die();
	}
	
	//Удаление
	add_action( 'wp_ajax_delBookingHome', 'delBookingHome' );
	add_action( 'wp_ajax_nopriv_delBookingHome', 'delBookingHome' );
	
	function delBookingHome(){
		global $wpdb;
		
		$delete = $wpdb->delete( 'wp_olly_home', [ 'id'=>$_POST['id'] ], [ '%d' ] );
	
		if ($delete!=0) {
			echo "Бронь успешно удалена";
		} else { echo $wpdb->$last_error; echo "Ошибка удаления брони. Попробуйте еще раз.";}
		wp_die();
	}

	//Получение
	/*add_action( 'wp_ajax_getBookingHome', 'getBookingHome' );
	add_action( 'wp_ajax_nopriv_getBookingHome', 'getBookingHome' );
	
	function getBookingHome(){
		
		global $wpdb;
		
		if (!isset($_GET['date']) ||$_GET['date']==""){
			$date=date("Y-m-d");    
		} else {
			$date=$_GET['date'];
		}
						
		if (!isset($_GET['type'])){
			$type="Проектный дом";
		} else {
			$type=$_GET['type'];
		}
		
		$wild = '%';
		$like = $wild . $wpdb->esc_like( $date ) . $wild;
		$sql = $wpdb->prepare( "SELECT * FROM wp_olly_home WHERE type = %s AND date_start LIKE %s",$type, $like  );
		$bookings = $wpdb->get_results($sql);
					
		var_dump ($bookings);
									
		if (!$bookings) {
			return "Броней не найдено.";
		} else {
			wp_send_json( $bookings );
		}		
	}*/

// создание маршрута
add_action( 'rest_api_init', function(){

	// пространство имен
	$namespace = 'olly';

	// маршрут
	$rout = '/booking/';

	// параметры конечной точки (маршрута)
	$rout_params = [
		'methods'  => 'POST',
		'callback' => 'bookingHome',
		'args'     => [
			'dateTimeStart' => [
				'type'     => 'string',
				'required' => true,    
			],
			'dateTimeEnd' => [
				'type'    => 'string', 
				'required' => true,        
			],
			'services' => [
				'type'    => 'string', 
				'required' => true,        
			],
			'type' => [
				'type'    => 'string', 
				'required' => true,        
			],			
			'information' => [
				'type'    => 'string',        
			],
			'employee' => [
				'type'    => 'integer', 
				'required' => true,        
			],				
		],
		'permission_callback' => function( $request ){
			// только авторизованный юзер имеет доступ к эндпоинту
			return true;
		},
	];

	register_rest_route( $namespace, $rout, $rout_params );

} );

	// функция обработчик конечной точки (маршрута)
	function bookingHome( WP_REST_Request $request ){

			global $wpdb;
			
			$sql = $wpdb->prepare( "SELECT * FROM wp_olly_home t WHERE type = %s AND (%s between t.date_start and t.date_end or %s between t.date_start and t.date_end)", $request['type'], $request['dateTimeStart'],$request['dateTimeEnd'] );
			$result = $wpdb->get_results($sql);
			
			if ($result!=null) {return new WP_Error( 'no_booking', 'Данные даты на '.$request['type'].' уже забронированы', [ 'status' => 400 ] );}
			else {
			
				$insert = $wpdb->insert( 'wp_olly_home',
					[	'information' => $request['information'], 
						'date_start' =>$request['dateTimeStart'],
						'date_end' =>  $request['dateTimeEnd'],
						'employee' =>  $request['employee'],
						'type' =>  $request['type'],
						'services' =>  $request['services'],
					]
				);
			
				if (	$insert != false	)	{	return "Бронирование успешно";	}
				else {return new WP_Error( 'booking_error', 'Ошибка бронирования', [ 'status' => 400 ] );}
				
			}
			
	}	
	
	// создание маршрута
	add_action( 'rest_api_init', function(){

		// пространство имен
		$namespace = 'olly';

		// маршрут
		$rout = '/booking/';

		// параметры конечной точки (маршрута)
		$rout_params = [
			'methods'  => 'GET',
			'callback' => 'getBookingHome',
			'args'     => [
				'date' => [
					'type'     => 'string',
					'required' => true,    
				],
			],
			'permission_callback' => function( $request ){
				// только авторизованный юзер имеет доступ к эндпоинту
				return true;
			},
		];

		register_rest_route( $namespace, $rout, $rout_params );

	} );

	// функция обработчик конечной точки (маршрута)
	function getBookingHome( WP_REST_Request $request ){

			global $wpdb;

			//$wild = '%';
			//$like = $wild . $wpdb->esc_like( $request['date'] ) . $wild;
			$sql = $wpdb->prepare( "SELECT * FROM wp_olly_home t WHERE DATE(t.date_start) = %s OR %s between t.date_start and t.date_end",$request['date'],$request['date']  );
			$bookings = $wpdb->get_results($sql);
														
			if (!$bookings) {
				return new WP_Error( 'get_booking_error', 'Броней на эту дату не найдены', [ 'status' => 404 ] );
			} else {
				return $bookings;
			}					
	}


	// создание маршрута
	add_action( 'rest_api_init', function(){

		// пространство имен
		$namespace = 'olly';

		// маршрут
		$rout = '/booking/';

		// параметры конечной точки (маршрута)
		$rout_params = [
			'methods'  => 'DELETE',
			'callback' => 'deleteBookingHome',
			'args'     => [
				'id' => [
					'type'     => 'string',
					'required' => true,    
				],
			],
			'permission_callback' => function( $request ){
				// только авторизованный юзер имеет доступ к эндпоинту
				return true;
			},
		];

		register_rest_route( $namespace, $rout, $rout_params );

	} );

	// функция обработчик конечной точки (маршрута)
	function deleteBookingHome( WP_REST_Request $request ){

		global $wpdb;
		
		$delete = $wpdb->delete( 'wp_olly_home', [ 'id'=>$request['id'] ], [ '%d' ] );
	
		if ($delete!=0) {
			return "Бронь успешно удалена";
		} else { return new WP_Error( 'delete_booking_error', 'Ошибка удаления брони', [ 'status' => 404 ] );}
						
	}
