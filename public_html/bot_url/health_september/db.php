<?
	define('WP_USE_THEMES', false);
	require('../../wp-blog-header.php');

	
	$wpdb = new wpdb( 'cf78864_ollyteam', 'f17ollyteaM17', 'cf78864_ollyteam', 'localhost' );
	
	// если не удалось подключиться, и нужно оборвать PHP с сообщением об этой ошибке
	if( ! empty($wpdb2->error) )
		wp_die( $wpdb2->error );
?>