<?

/*
 * Template name: Тест вывода пользователей
 * Template post type: page
 */



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


?>