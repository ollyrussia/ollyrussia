<?
//Подключаем Яндекс.Кассу

	require __DIR__ . '/lib/autoload.php'; 
	use YandexCheckout\Client;

	$client = new Client(); 
	//$client->setAuth('721336', 'live_AVR-2CRJfyfPOvwnsJXZwJacLJGM0HKlpPzpgMAsir8'); //Боевая
	$client->setAuth('722898', 'test_22R22fypaS3hPbAt4vzQTk8BZK45CDy8_N57CPzf6Qg');
	
	$payment = $client->getPaymentInfo($_COOKIE['pid']);
	$status = $payment['_status'];

	if ($status=='succeeded')
	{
	    $url = 'https://ollyteam.ru/?page_id=113';
	}
	elseif($status=='canceled')
	{
		$url = 'https://ollyteam.ru/?page_id=118';
	}
	
	
	
	header('Location:'.$url);
?>