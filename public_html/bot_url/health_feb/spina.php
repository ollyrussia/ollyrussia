
<?
//Бот распределятор ссылок / СПИНА

include_once "Telegram.php";

define('WP_USE_THEMES', false);
require('../../wp-blog-header.php');


/*---------------------------------------------------------*/
//Настройки для бота

//Токен бота
$telegram = new Telegram('1597535716:AAFoBqLTwP5Tnya6iIkK_Koddaim6hkpQn8');
//Ссылки
$links = array(
    0=>"https://t.me/joinchat/VLfm9SFNMb6RHJEp",
    1=>"https://t.me/joinchat/RJBxfTlmtGvBex_s",
    2=>"https://t.me/joinchat/Ryqx_1MeGCJhSrt7",
    3=>"https://t.me/joinchat/Tc_J-0AavXZ-JfTf",
    4=>"https://t.me/joinchat/V30C42yKEz_9mAG1",
    5=>"https://t.me/joinchat/UWMhcZ8tmWCL5PV_",
    6=>"https://t.me/joinchat/HExvd90dMe5il8GH",
    7=>"https://t.me/joinchat/GaSuxtc9k3vvnFDh",
    8=>"https://t.me/joinchat/U5JT0PBSGpqA_jO1",
    9=>"https://t.me/joinchat/V_Yi3YT3p2YjvJab",
    10=>"https://t.me/joinchat/IgbWaymISZGZkSH8",
    11=>"https://t.me/joinchat/E8iQm8X8t3KGJdCx",
    12=>"https://t.me/joinchat/HzxLo3dnuyvPc5YR",
    13=>"https://t.me/joinchat/HYAibV0wSVOW6nbb",
    14=>"https://t.me/joinchat/IiMmnTqFuaw3kAVN",
    

    
);
//База
$db = "bot_health_spina_feb";
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







