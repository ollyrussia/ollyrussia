<?
	#Вывод промокодов
	define('WP_USE_THEMES', false);
	require('../wp-blog-header.php');

	global $wpdb;
    
    $result = $wpdb->get_results( "SELECT * FROM `promocode`");
    
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