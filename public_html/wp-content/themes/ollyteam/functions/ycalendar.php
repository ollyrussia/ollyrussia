<?
error_reporting(E_ALL);
ini_set('display_errors', '1');

	$company_id=542516;
	//global $wp_filesystem;
	//global $wpdb;
	
	//// Установка ключа API, логина и пароля
	$api_key = 'rf55gcwyhzpa5h6xeb4c';
	$login = 'andrtos@gmail.com';
	$password = '2o7GMpVL!!4';
	
	require_once ('libs/yclients/custom_ycl_v2.php');
	
	$user_token=get_user_token($company_id, $login, $password, $api_key);

	$data['staff_id']=2160900;
	//$data['start_date']=date('Y-m-d', time()+86400);
	$data['start_date']='2023-04-18';
	getRecords($company_id, $user_token, $api_key, $data);
?>