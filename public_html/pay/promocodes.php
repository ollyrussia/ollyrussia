<?
	#Вывод промокодов
/*	define('WP_USE_THEMES', false);
	require('../wp-blog-header.php');*/
	header('Access-Control-Allow-Origin: *');
	define( 'SHORTINIT', true );
	require_once('../wp-load.php' );

	global $wpdb;
    
    $result = $wpdb->get_results( "SELECT * FROM `promocode_2023`");
    
    //var_dump($result);
    $promokods=[];
    $i=0;
    
    if ($result)
    {
      foreach ( $result as $row ) {
      	
      	$promokods[$i] = array(
        'name' => $row->name,
        'discount' => $row->discount,
		 );
		 
		 $i++;
      }
    	
    }
    
    echo json_encode($promokods,JSON_UNESCAPED_UNICODE);
?>