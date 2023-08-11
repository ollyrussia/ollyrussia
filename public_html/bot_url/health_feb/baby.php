
<?
//Бот распределятор ссылок / ДЕТИ

include_once "Telegram.php";

define('WP_USE_THEMES', false);
require('../../wp-blog-header.php');


/*---------------------------------------------------------*/
//Настройки для бота

//Токен бота
$telegram = new Telegram('1548542229:AAER7chOT-D8P8EsLiT5LPGVvD3uOT09x38');
//Ссылки
    /*0=>"https://t.me/joinchat/TYYoFEe_XqAumgOD",
    1=>"https://t.me/joinchat/UpehA7vXafEt31Un",
    2=>"https://t.me/joinchat/Ut5F0ueHdxckflUt",
    3=>"https://t.me/joinchat/SJJ8qbnYY525nhZw",
    4=>"https://t.me/joinchat/ThgyhrOGOFmF6JYr",
    5=>"https://t.me/joinchat/U2pofRHOEhR6MfHY",
    6=>"https://t.me/joinchat/U6A5s7W3BFXLImXL",
    7=>"https://t.me/joinchat/TQ7U1upTmpoX8-3T",
    8=>"https://t.me/joinchat/R5kPuftbcFoB6m4l",
    9=>"https://t.me/joinchat/VNJhLcbECzhXx0L2",
    10=>"https://t.me/joinchat/WGcKamoGMUDLfSHS",
    11=>"https://t.me/joinchat/Gjm81EkVKPOE0yaD",
	12=>"https://t.me/joinchat/Ua6dCnRgqjf891jE",
	13=>"https://t.me/joinchat/FIvquyz3vMPire1Y",
	14=>"https://t.me/joinchat/HOK9pzVIE9ph0EdF",
	15=>"https://t.me/joinchat/TRmt1BG4ZJ3pNQCS",
	16=>"https://t.me/joinchat/HJQx2ZtWJ-ZJ9U1J",
	17=>"https://t.me/joinchat/UiZJ0wDe_HvqE5iC",
	18=>"https://t.me/joinchat/SmkPyDbBSpwD1Aej",
	19=>"https://t.me/joinchat/SnAJY_2Tk4tg8iCr",
	20=>"https://t.me/joinchat/IwQfvz9fSoRPFsU3",
	21=>"https://t.me/joinchat/F7OkHVgOBroR7LRO",
	22=>"https://t.me/joinchat/IS1uGkRWzmPM-KoO",
	23=>"https://t.me/joinchat/GkfZTzTUj2Xrt40F",
	24=>"https://t.me/joinchat/GOJT_76Y-EbZF3Mr",
	25=>"https://t.me/joinchat/H3UooTtIp_glhYww",
	26=>"https://t.me/joinchat/InkKH3vK4ojaK24n",
	*/
$links = array(

	0=>"https://t.me/joinchat/SzvLc9bms41WEU2U",
	1=>"https://t.me/joinchat/GCHWw-yIbDc75j3u",

);
//База
$db = "bot_health_baby_feb_2";
/*---------------------------------------------------------*/



$text = $telegram->Text();
$chat_id = $telegram->ChatID();

if ($text == '/start') {
    $option = [["Получить ссылку"]];
    // Create a permanent custom keyboard
    $keyb = $telegram->buildKeyBoard($option, $onetime = true); 
    $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Приветствую!\nЯ бот распредeлитель участников марафона по чатам телеграм.\nНапиште команду /get или нажмите на кнопку 'Получить ссылку'."];
    $telegram->sendMessage($content);
}
elseif ($text=='Получить ссылку' || $text=='/get')
{
	$content = array('chat_id' => $chat_id, 'text' => "Чтобы получить ссылку напишите, пожалуйста, свой номер телефона, который вы оставляли при регистрации на марафон:");
	$telegram->sendMessage($content,'html');
}

elseif (isNumeric($text))
{
		/*Добавляем в базу телефон, какой по счету, id чата*/
		$ptn = "/[^0-9]/";
		$rpltxt = "";
		$phone = preg_replace($ptn, $rpltxt, $text);
		
		$isId = $wpdb->get_row( "SELECT * FROM $db WHERE id_tg= $chat_id");
		if ($isId!=NULL)
		{
			$msg = "Ваша ссылка:".$isId->url;
		}
		else
		{
			//Какое количество записей сейчас
			$amount = $wpdb->get_var( "SELECT COUNT(1) FROM $db");
			
			//Какая ссылка для пользователя
			$link = $links[intval($amount/10)];	
			
			$amount++;
			
			if ($link!="")
			{
				//Записываем пользователя
				$wpdb->insert(
					$db,
					array( 'id_tg' => $chat_id, 'phone' => $phone, 'url' =>$link )
				);
				$msg = "Спасибо, ваша ссылка: ".$link;
				
			}
			else
			{
				$msg = "Чаты закончились. Напишите, пожалуйста, менеджеру.";
			}
			
			


		}
		
		$content = array('chat_id' => $chat_id, 'text' => $msg);
		$telegram->sendMessage($content,'html');
}
else 
{
	$content = array('chat_id' => $chat_id, 'text' => "Введите номер телефона.");
	$telegram->sendMessage($content,'html');
}



function isNumeric($str)
{
	preg_match("/[\d]+/", $str,$match);
	if (strlen($match[0]) > 0) {return true;} else {return false;}
}







