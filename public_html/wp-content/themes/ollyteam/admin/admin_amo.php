<?

/*$test = new EbClientAmocrm("q0x7NHOX2qVXqcMYvBvNv7jisrHVbHLhRKHEFB3JS5ivr5grXFAeaKz7OW5iLsZH", '96a0e6d5-57a8-4d8b-9554-869f35a954a6', 'alarikabox', 'https://ollyteam.ru/amo/', 'def50200101afd44a2662014a91a1093d8aa84e48e863d5fa13aa90c34488e0eb2f1bc743f85baed13817834e0e47e191d561fa8f2ef0b8a17952cabeecb2c9c3a71dc9907164094af80601fe7b2c5fc0e352cd605cd1be28c1ddb054ad8810cca23e8226f98ea5a8eea53cbb8a77ab62bd357c1bebdb614b2a249cd68fa9e30a48ca6f0a3659665bd56559d9451b1e7e6a09e65ea061b2216a3c169b12d6787f13d2f4c44f433a14a40e362534eeb0efdead85ab96f62bfec91449619cb43d73255c7ee2482a18b9c98e5121c574aa2334ba80974feda39d9afa8cea58d7c55d1a7393e85031ffb28041bff73ff562e1920d56b565891382b768d5aeae6b2aebb8988784730a862ba19fa53dc58164c0d06b12152ddfbdabaea640282e32756c8d965ec259490069d151f94f0d53faea3c2dcdfe27de4a317d2c3f225a60d3df7bc055e16a7fde62ac94475056d372c19dc83d9d88f36b737f635baca1739fd24f17ff830fbfc3388fd1d50a7c6a08f6695b30ce32e958deb809bb99e57f9db14ccc7c183b783f5f0a21039396434f90920d9fde8251f4098a04a027ff2a44f8e0985985871a4a0a4011e05f8e062bace2493a791a1f714abb6ebe2d887549763aeb864');
$lead_config = array(
    'name' => 'Тестовая сделка!',
    'sale' => '1000',
    'contacts_id' => 1,
    'custom_fields' => [
        [
            'id' => 190321,
            'value' => 'значение'
        ]
    ]
);
$lead = $test->create_lead($lead_config);
var_dump ($lead);*/


function getAllUsersInfo(){
	
	$data = [];
	
	$users = get_users('role=psychologist&orderby=meta_value&meta_key=last_name' );
	
	foreach ($users as $user) {
		$therapist_photo = get_the_author_meta( 'photo', $user->ID );
		$therapist_price = get_the_author_meta( 'price', $user->ID );
		$therapist_category= get_the_author_meta( 'category', $user->ID );
        $bot = get_the_author_meta('bot', $user->ID);
		$data[]= [
			"id"=>$user->ID,
			"first_name"=>$user->user_firstname,
			"last_name"=>$user->user_lastname,
			"price"=>$therapist_price,
			"photo_url"=>$therapist_photo,
			"category"=>$therapist_category,
            "bot"=>$bot,
		];

	}
	
	;
	
	//Ставим Сардарян и Гаджимурадову в топ списка
	$id_sardaryn = array_search("58", array_column($data, 'id'));
	$id_gadjimuradova = array_search("36", array_column($data, 'id'));
	
	$sardaryn = $data[$id_sardaryn];
	$gadjimuradova = $data[$id_gadjimuradova];
	
	unset($data[$id_sardaryn]);
	unset($data[$id_gadjimuradova]);
	
	array_unshift($data, $sardaryn, $gadjimuradova );
	
	
	return json_encode($data, JSON_UNESCAPED_UNICODE);
}

echo getAllUsersInfo();



/*require_once TEMPLATEPATH.'/functions/libs/yclients/YclientsApi.php';
require_once TEMPLATEPATH. '/functions/libs/yclients/YclientsException.php';
use Yclients\YclientsApi;*/
	
  //require_once ('/home/c/cf78864/Ollyteam.ru/public_html/wp-content/themes/ollyteam/functions/libs/yclients/YclientsApi.php');
	//require_once ('/home/c/cf78864/Ollyteam.ru/public_html/wp-content/themes/ollyteam/functions/libs/yclients/YclientsException.php');

//$yclients = new YclientsApi('rf55gcwyhzpa5h6xeb4c');
//var_dump($yclients);

?>