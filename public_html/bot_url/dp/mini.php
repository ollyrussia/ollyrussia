
<?
//Бот распределятор ссылок ДП по мини группам

include_once "Telegram.php";

define('WP_USE_THEMES', false);
require('../../wp-blog-header.php');


/*---------------------------------------------------------*/
//Настройки для бота

//Токен бота
$telegram = new Telegram('1451432726:AAHPU4RWpi4zWcGLfYnh4POFO4McAN3L4XA');

//Ссылки
$links = array(
	0 => "https://t.me/joinchat/LT6Rv1Nrc8k3FGcWIjQq6w",
	1 => "https://t.me/joinchat/LT6Rv1DgV98O-rqjJ2fi-g",
	2 => "https://t.me/joinchat/LT6Rv0XoDgndYCwhOzUECw",
	3 => "https://t.me/joinchat/LT6Rv1U3M8QLX6Zu_g-5Jg",
	4 => "https://t.me/joinchat/LT6Rv0kerPBq_xZQ5YZBYw",
	5 => "https://t.me/joinchat/LT6Rv09v3g6T7UY9_TfPdw",
	6 => "https://t.me/joinchat/LT6Rv1hlBmSXcmbh8RD8QQ",
	7 => "https://t.me/joinchat/LT6Rv03h1Vtwt-jM6GgDug",
	8 => "https://t.me/joinchat/LT6Rv0ddf6hZzroQVlfykw",
	9 => "https://t.me/joinchat/LT6Rv1LyT3NMBA2-8o1cqg",
	10 => "https://t.me/joinchat/LT6Rv0bhvOSJahfit8Gtjw",
	11 => "https://t.me/joinchat/LT6Rv1ITyD-A8bGrv5l4uw",
	12 => "https://t.me/joinchat/LT6Rv1BqoimTz5JZcahExg",
	13 => "https://t.me/joinchat/LT6Rv1EWNEDKWHEdfJwKAw",
	14 => "https://t.me/joinchat/LT6Rv1GKV8xrVduE5C0wIg",
	15 => "https://t.me/joinchat/LT6Rv1kd3eQtv2cVTjK29A",
	16 => "https://t.me/joinchat/LT6Rv06V140VTJT9Y1Dqgw",
	17 => "https://t.me/joinchat/LT6Rv1gDPm6MLXFk6f7yvw",
	18 => "https://t.me/joinchat/LT6Rv0qfGcUmzg-ehNsJpw",
	19 => "https://t.me/joinchat/LT6Rv0QM0-J5gkRLXBWnxw",
	20 => "https://t.me/joinchat/LT6RvxoQTKyiWWoWnQUO_g",
	21 => "https://t.me/joinchat/LT6Rv0UB3T_VJ46UY13ESw",
	22 => "https://t.me/joinchat/LT6Rv0Qa_wJGudgDI1epPA",
	23 => "https://t.me/joinchat/LT6Rv0WwQbxEDaMhB1eO6Q",
	24 => "https://t.me/joinchat/LT6Rv1eExiYe9XrNlYNyBQ",
	25 => "https://t.me/joinchat/LT6Rv0ii2hCrxF5XPCc6kg",
	26 => "https://t.me/joinchat/LT6Rv0SwpPPB2Y9_hLdqWg",
	27 => "https://t.me/joinchat/LT6Rvx2nNrMXbqZMo4hlbQ",
	28 => "https://t.me/joinchat/LT6Rv1auizOOelT8ZweMFQ",
	29 => "https://t.me/joinchat/LT6Rv1ICeT1TvDjC9Fxr1Q",
	30 => "https://t.me/joinchat/LT6Rv0hKeTaVZUvt1sSgEw",
	31 => "https://t.me/joinchat/LT6RvxvLIp1i6qQmw_B7SQ",
	32 => "https://t.me/joinchat/LT6Rvx0EY2JCwg_QIuU7bg",
	33 => "https://t.me/joinchat/LT6RvxvNfFbNqkZjRs8klg",
	34 => "https://t.me/joinchat/LT6RvxtSxPfcaqcVJMlMgw",
	35 => "https://t.me/joinchat/LT6RvxbyWp4oYHDloy1Plg",
	36 => "https://t.me/joinchat/LT6RvxsiF6CfxTNJxNMUWA",
	37 => "https://t.me/joinchat/LT6RvxiBlrRF8skIlJth6g",
	38 => "https://t.me/joinchat/LT6Rvx0bz4psz4_s9oB2jg",
	39 => "https://t.me/joinchat/LT6Rvxw5iy8jyexoP-hM8Q",
);
//База
$db = "bot_dp_mini";
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
			$msg = "Ваша ссылка: ".$isId->url;
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







