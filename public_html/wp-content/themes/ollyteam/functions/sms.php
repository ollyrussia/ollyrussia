<?

	//Ключ от P1smc - XBJ495cvFu5tzInWZCwfODOeUMcd5NoMCwR6eqGgxx83Cum0869yKk2dvnVT
	
	function send_sms($msg,$phone)
	{
		$date = new DateTime();
		
		if( $curl = curl_init() ) 
		{
			$args = [
				"apiKey"=>"XBJ495cvFu5tzInWZCwfODOeUMcd5NoMCwR6eqGgxx83Cum0869yKk2dvnVT",
				"sms"=>[[
					"channel"=> "char",
					"phone" => $phone,
				    "text"=> $msg,
				    "sender"=> "OLLY_RUSSIA"
				]]
			];
			
	        curl_setopt($curl, CURLOPT_URL, 'https://admin.p1sms.ru/apiSms/create');
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($curl, CURLOPT_POST, true);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args,JSON_UNESCAPED_UNICODE));
	        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'accept: application/json'));
	        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	        $out = curl_exec($curl);
			        
	        curl_close($curl);
		}
		
		return $out;

		
	}