<?
	//Получение промокода
	add_action( 'wp_ajax_getPromocode', 'getPromocode' );
	add_action( 'wp_ajax_nopriv_getPromocode', 'getPromocode' );
	function getPromocode()
	{

		global $wpdb;
		
		$return = array();
		
		$sql = $wpdb->prepare( "SELECT discount FROM wp_olly_promocode WHERE name = %s", $_POST['promocode'] );
    	$result = $wpdb->get_var($sql);
    	
    	$return['discount']=$result;
    		
    	echo json_encode($return,JSON_UNESCAPED_UNICODE);
		wp_die();
    
	}

