<?
// получение токена авторизации
function get_user_token($company_id, $login, $password, $api_key) {
    $url = "https://api.yclients.com/api/v1/auth";
    $headers = array(
        "Content-Type: application/json",
        "Accept: application/vnd.yclients.v2+json",
		"Authorization: Bearer ".$api_key,
    );
    $data = array(
        "login" => $login,
        "password" => $password
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
	//var_dump ($data);
    $result = json_decode($response, true);
    if (isset($result['data']["user_token"])) {
        return $result['data']["user_token"];
    } else {
        file_put_contents('ycl.log', date('Y-m-d H:i:s')." Получение токена авторизации ".json_encode($response, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
        return null;
    }
}

// Ищем клиента по номеру телефона
function search_or_create_client($company_id, $user_token, $api_key, $phone_number, $email, $name) {
    $url = "https://api.yclients.com/api/v1/company/$company_id/clients/search";
    $headers = array(
		"Content-Type: application/json",
        "Accept: application/vnd.yclients.v2+json",
        "Authorization: Bearer $api_key, User $user_token",
    );
    $data["filters"][0]["type"]="quick_search";
	$data["filters"][0]["state"]["value"]=$phone_number;

	$data["fields"][0]="id";
	$data["fields"][1]="name";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    //if ($http_code == 200) {
    // Если клиент найден, возвращаем его ID
    $result = json_decode($response, true);
	//var_dump ($result);
    if (isset($result['data'][0]["id"])) {
		return $result['data'][0]["id"];
    } else {
        // Если клиент не найден, создаем нового
        $url = "https://api.yclients.com/api/v1/clients/$company_id";
        $headers = array(
            "Content-Type: application/json",
            "Accept: application/vnd.yclients.v2+json",
            "Authorization: Bearer $api_key, User $user_token",
        );
        $data = array(
            "phone" => $phone_number,
            "email" => $email,
			"name" => $name,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result = json_decode($response, true);
		//var_dump ($result);
		if (isset($result['data']["id"])) {
            // Если клиент успешно создан, возвращаем его ID
            return $result['data']["id"];
        }
		if (!isset($result['data']["id"])) file_put_contents('ycl.log', date('Y-m-d H:i:s')." 1 ".json_encode($response, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
    }
}

// echo "\n\nПолучить все транзакции==========================================================================\n\n";
function getFinance($company_id, $user_token, $api_key) {
    $url = "https://api.yclients.com/api/v1/transactions/$company_id";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "Authorization: Bearer $api_key, User $user_token",
        'Accept: application/vnd.yclients.v2+json'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	$result = json_decode($response, true);
	//var_dump($result);

    return $result;
}

// echo "\n\nПолучить все записи компании==========================================================================\n\n";
function getRecords($company_id, $user_token, $api_key, $data=array()) {
	
    $url = "https://api.yclients.com/api/v1/records/$company_id".'/?'.http_build_query($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "Authorization: Bearer $api_key, User $user_token",
        'Accept: application/vnd.yclients.v2+json'
    ));	
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	$result = json_decode($response, true);
	var_dump($result);

    return $result;
}

//echo "\n\nСоздание транзакции пополнения счета==========================================================================\n\n";
function addFinance($company_id, $price_good, $expense_id, $account_id, $client_id, $user_token, $api_key) {
    $url = "https://api.yclients.com/api/v1/finance_transactions/$company_id";

	date_default_timezone_set('Europe/Moscow');
	$now = new DateTime();
	$formatted_date = $now->format('Y-m-d H:i:s');

	$data["expense_id"]=$expense_id;
	$data["amount"]=$price_good;
	$data["account_id"]=$account_id;
	$data["client_id"]=$client_id;
	$data["date"]=$formatted_date;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "Authorization: Bearer $api_key, User $user_token",
        'Accept: application/vnd.yclients.v2+json'
    ));
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	$result = json_decode($response, true);
	//var_dump($result);
	if (!isset($result['data']['id'])) file_put_contents('ycl.log', date('Y-m-d H:i:s')." Создание транзакции пополнения счета ".json_encode($response, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
    return $result['data']['id'];
}

// "\n\nПоиск товаров==========================================================================\n\n";
function getGoods($company_id, $name_good, $price_good, $user_token, $api_key) {
    $url = "https://api.yclients.com/api/v1/goods/$company_id/";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "Authorization: Bearer $api_key, User $user_token",
        'Accept: application/vnd.yclients.v2+json'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	$result = json_decode($response, true);
	var_dump($result);

	for ($i=0; $i<count($result['data']); $i++) {
		if ($result['data'][$i]["title"]==$name_good && $result['data'][$i]["cost"]==$price_good) {
			return $result['data'][$i]["good_id"];
			break;
		}
	}
	if (!isset($result['data'][0]["good_id"])) file_put_contents('ycl.log', date('Y-m-d H:i:s')." Поиск товаров ".json_encode($response, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);

    return null;
}

// "\n\nСоздание складской операции==========================================================================\n\n";
function addOperation($company_id, $storage_id, $id_good, $price_good, $master_id, $client_id, $user_token, $api_key) {
    $url = "https://api.yclients.com/api/v1/storage_operations/operation/$company_id";

	$data["type_id"]=1;
	$data["create_date"]=time();
	$data["master_id"]=$master_id;
	$data["storage_id"]=$storage_id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "Authorization: Bearer $api_key, User $user_token",
        'Accept: application/vnd.yclients.v2+json'
    ));
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	$result = json_decode($response, true);
	//var_dump($result);
	if (!isset($result['data']['document']['id'])) file_put_contents('ycl.log', date('Y-m-d H:i:s')." Создание складской операции ".json_encode($response, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);

    return $result['data']['document']['id'];
}

//echo "\n\nСоздание товарной транзакции==========================================================================\n\n";
function buyGoods($company_id, $document_id, $id_good, $price_good, $master_id, $client_id, $user_token, $api_key) {
    $url = "https://api.yclients.com/api/v1/storage_operations/goods_transactions/$company_id";

	$data["document_id"]=$document_id;
	$data["good_id"]=$id_good;
	$data["amount"]=1;
	$data["cost_per_unit"]=$price_good;
	$data["discount"]=0;
	$data["cost"]=$price_good;
	$data["operation_unit_type"]=1;
	$data["master_id"]=$master_id;
	$data["client_id"]=$client_id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "Authorization: Bearer $api_key, User $user_token",
        'Accept: application/vnd.yclients.v2+json'
    ));
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
	$result = json_decode($response, true);
	var_dump($result);

	if (!isset($result['data']['id'])) file_put_contents('ycl.log', date('Y-m-d H:i:s')." Создание товарной транзакции ".json_encode($response, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);

    return $result;
}




	?>