<?php
/*
 * Простая PHP библиотека для работы с API AmoCRM
 * Документация Amocrm: https://www.amocrm.com/developers/content/api/account/
 * 
*/
class SimpleAmoApi {
	private $auth = [
		'subdomain' => 'alarikabox',
		'client_id' => 'ec24e095-0ece-47dc-86a7-0f3d250590fc',
		'client_secret' => 'UTv0OgArDajViAg0LOz6cRUHza1RHtxJNgIjJfiIIKFhgtQUO8LpLsbL6QNnBjsn',
		'grant_type' => 'authorization_code',
		'code' => 'def50200237abe4cbf4fd83fb0f2c9ff6f7d6ab3a4c165cb735080345a135108535da709e5b2e393e0be7ea6bc50f3cb74c56d8231407e5d877c9780208f58114723ddaf7cac95db44d9d36e1f09c0ab28f54e3d6e67d70f5cdca9bd1545c17d2b3dc553eddbbcdb982d41f294741c64e4bb9bec1adfe497984790975c6177ce23357eaeacc01db450b8a8db09562246d1344688fc08e7e38c122c8c5c0dc10d28e79f4cbc74e9fd3925a1dd338ee9a4ccc673db955479f360044a849e9d9ee7731fb6e3fba79f815f34f703098e9d0b52fd077624507d32dd71d8a4249df0b36be57d7eb865527fb9e1a2b443631c08cb036bf7fbf8e4ec7ccc21a7d46a032c2583e607c743a1f9c7306f3aba157a2c00af6e62f783d3735e069b5759eaca774b0f3f14e0180275cd77a8d908560796af8331ba502fb2a2d29eb7769dcfd839cd51014d86f5436366ef9ac0008355eba70cc728ad8d21e998958a3d9fc0fb086dbfc62efae6d9e5a833a68c2a427ec8cb8db8261f1ca1ce67ff010a6b5bb510455779618931e03cb94d24ea7bb3a047531febd271867163e57dde8969ea007f4b0369f1b39146d254e27c9f09aaf4db484692c9e67bfe3679482226fc7f655b83354babe204bbd743067c6bc2dc046d7bbc7361458e63074c04b5a39e24329fa1',
		'redirect_uri' => 'https://ollyteam.ru/tilda/birth_women_target/amo.php',
	];
	
	private $tokens;
    
	function __construct() {
		if ( !$this->auth['client_secret'] ) self::ThrowError('Empty Auth Info');
		
		# Получаем access_token
		
		# Если есть файл с полученными ранее ключами
		if ( file_exists(__DIR__ . '/auth.json') ) {
			# Что бы не сверять время жизни ключа, просто генерируем новый
			$authInfo = json_decode( file_get_contents(__DIR__ . '/auth.json') );
			
			if ( !$authInfo->refresh_token ) self::ThrowError('Empty Refresh Token');
			
			# Обновляем access_token
			$newTokens = $this->refreshAccessToken( $authInfo->refresh_token );
			
			# Если новые токены есть, пишем их в файл
			if ( $newTokens->access_token ) {
				$newAuthJson = json_encode($newTokens);
				file_put_contents(__DIR__ . '/auth.json',$newAuthJson);
				
				$this->tokens = $newTokens;
			} else {
				self::ThrowError('Error. Cant generate new Access Token');
			}
		} else {
			
			# Генерируем первый раз ключи
			$newTokens = $this->getAccessToken();
			
			# Если новые токены есть, пишем их в файл
			if ( $newTokens->access_token ) {
				$newAuthJson = json_encode($newTokens);
				file_put_contents(__DIR__ . '/auth.json',$newAuthJson);
				
				$this->tokens = $newTokens;
			} else {
				self::ThrowError('Error. Cant generate Access Token');
			}
		}
		
			
		echo '<pre>';
		print_r($newTokens);
		//die();
		
		return;
	}
	
	function getAccessToken(){
		$data = [
			'client_id' => $this->auth['client_id'],
			'client_secret' => $this->auth['client_secret'],
			'grant_type' => 'authorization_code',
			'code' => $this->auth['code'],
			'redirect_uri' => $this->auth['redirect_uri'],
		];
		
		$newTokens = $this->SendRequest( 'oauth2/access_token', $data );
		
		return $newTokens;
	}
	
	function refreshAccessToken( $refreshToken ){
		$data = [
			'client_id' => $this->auth['client_id'],
			'client_secret' => $this->auth['client_secret'],
			'grant_type' => 'refresh_token',
			'refresh_token' => $refreshToken,
			'redirect_uri' => $this->auth['redirect_uri'],
		];
		
		$newTokens = $this->SendRequest( 'oauth2/access_token', $data );
		
		return $newTokens;
	}
	
	# https://www.amocrm.com/developers/content/api/account/
	function getAccount( $data = 'with=pipelines,groups,users,custom_fields' ){
		$method = 'api/v2/account';
		
		$response = $this->SendGETRequest( $method, $data );
		
		return $response;
	}
	
	# https://www.amocrm.com/developers/content/api/leads/
	function getLeads( $data = '' ){
		$method = 'api/v2/leads';
		
		$response = $this->SendGETRequest( $method, $data );
		
		return $response;
	}

	/* Мои функции */



	function addLeads( $data ){
		$method = 'api/v2/leads';
		
		$response = json_decode(json_encode($this->SendRequest( $method, $data ,1 )),true);
		
		return $response['_embedded']['items'][0]['id'];
	}
	
	function updateLeads( $data ){
		$method = 'api/v2/leads';
		
		$response = json_decode(json_encode($this->SendRequest( $method, $data ,1 )),true);
		
		return $response['_embedded']['items'][0]['id'];
	}
	
	function addNote($data)
	{
		$method = 'api/v2/notes';
		$response = $this->SendRequest( $method, $data ,1 );
		
		return $response;
		
	}
	
	function addContacts( $data ){
		$method = 'api/v2/contacts';
		
		$response = $this->SendRequest( $method, $data ,1 );
		return $response ;
	

	}

	
	# https://www.amocrm.com/developers/content/api/contacts/
	function getContacts( $data = '' ){
		$method = 'api/v2/contacts';
		
		$response = $this->SendGETRequest( $method, $data );
		
		return $response;
	}
	
	private function SendRequest( $method = '', $data = [], $sendToken = 0 ) {
		if ( !$method ) self::ThrowError('No Method in POST Request');
		
		$url = 'https://' . $this->auth['subdomain'] . '.amocrm.ru/' . $method;

		if (!$curld = curl_init()) {
			self::ThrowError('Curl Error');
		}
		
		if ( $sendToken ) {
			$header = [
				'Authorization: Bearer ' . $this->tokens->access_token
			];
		} else {
			$header = [
				'Content-Type: application/json'
			];
		}
		
		$verbose = fopen('php://temp', 'w+');
		
		curl_setopt($curld,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curld,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
		curl_setopt($curld,CURLOPT_URL, $url);
		if ( $header ) {
			curl_setopt($curld,CURLOPT_HTTPHEADER,$header);
		}
		curl_setopt($curld,CURLOPT_HEADER, false);
		if ( !empty($data) ) {
			curl_setopt($curld,CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($curld,CURLOPT_POSTFIELDS, json_encode($data));
		}
		curl_setopt($curld,CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($curld,CURLOPT_SSL_VERIFYHOST, 2);
		
		$output = curl_exec($curld);
		curl_close($curld);
		
		if ( $output === FALSE ) {
			self::ThrowError("cUrl error: ".curl_errno($curld).' '.htmlspecialchars(curl_error($curld)));
		}

		rewind($verbose);
		$verboseLog = stream_get_contents($verbose);
		
		$response = json_decode($output);
		
		return $response;
	}
	
	private function SendGETRequest($method = '', $data = '' ){
		if ( !$method ) self::ThrowError('No Method in GET Request');
		
		$url = 'https://' . $this->auth['subdomain'] . '.amocrm.ru/' . $method;
		
		if ( $data ) :
			$url .= '?'. $data;
		endif;
		
		$opts = array(
			'http'=>array(
				'method'=>"GET",
				'header'=> 'Authorization: Bearer ' . $this->tokens->access_token
			)
		);

		$context = stream_context_create($opts);

		$response = file_get_contents($url, false, $context);
		
		return json_decode($response);
	}
	
	function ThrowError( $message ) {
		echo '<div style="margin: 30px 0; padding: 15px; text-align: center; color: #222; background: #ffdbdb;">';
		echo '<div style="margin: 0 0 10px; font-weight: 700;">Error:</div>';
		echo ( $message ) ? $message : 'Unknown problem';
		echo '</div>';
		die();
	}
}
