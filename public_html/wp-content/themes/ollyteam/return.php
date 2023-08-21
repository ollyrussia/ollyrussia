<?

	/*
	Template Name: Возврат с кассы
	*/

	//use YooKassa\Client;
	//require __DIR__ . '/functions/libs/lib/autoload.php'; 

	
	use YooKassa\Client;

	$client = new Client(); 
	$client->setAuth('721336', 'live_AVR-2CRJfyfPOvwnsJXZwJacLJGM0HKlpPzpgMAsir8');
	//$client->setAuth('722898', 'test_22R22fypaS3hPbAt4vzQTk8BZK45CDy8_N57CPzf6Qg');
	
	$payment = $client->getPaymentInfo($_COOKIE['pid']);
	$status = $payment['_status'];

	if ($status=='succeeded')
	{
	    $url = 'https://ollyteam.ru/payment_success/';
	}
	elseif($status=='canceled')
	{
		$url = 'https://ollyteam.ru/payment_error/';
	}
	
	header('Location:'.$url);
?>