
<?
//Бот распределятор ссылок / ЗРЕНИЕ

include_once "Telegram.php";

define('WP_USE_THEMES', false);
require('../../wp-blog-header.php');


/*---------------------------------------------------------*/
//Настройки для бота

//Токен бота
$telegram = new Telegram('1593204046:AAE-_RrPVNbvxLx3nczwB2PxXTGYABkPMLk');

//Ссылки
$links = array(
    0=>"https://t.me/joinchat/V70xkaV963THTU-O",
    1=>"https://t.me/joinchat/WK3932M2VKpM10Fa",
    2=>"https://t.me/joinchat/TxhtrdZ6_DAidTvV",
    3=>"https://t.me/joinchat/R6wDstYiPxJOwLly",
    4=>"https://t.me/joinchat/Uw1sNZje3UKGDW8f",
    5=>"https://t.me/joinchat/UNjClN_7BgKLRmEu",
    6=>"https://t.me/joinchat/Ss_O9OnGT7o1CZaN",
    7=>"https://t.me/joinchat/UOKDfdw6Hmz-bbOZ",
    8=>"https://t.me/joinchat/Vy_mkJJEphASZ19R",
    9=>"https://t.me/joinchat/Hcc6Iu6DqTUIcvKL",
    10=>"https://t.me/joinchat/IcbT95QLw0LiouYP",
    11=>"https://t.me/joinchat/GjJbKbwWDCWYdRMu",
    12=>"https://t.me/joinchat/GySU-GveW9eEMQ29",
    13=>"https://t.me/joinchat/HKYe3g6_unQPm7uM",
    14=>"https://t.me/joinchat/Hpi5Nphd-RqOQp6_",
    15=>"https://t.me/joinchat/Hilfv3qEwMFPXHpx",
    16=>"https://t.me/joinchat/IWbat_Nw4lgnZclt",
    17=>"https://t.me/joinchat/Hy6FHca-_ANw6yye",
    18=>"https://t.me/joinchat/Ih14L-alpSkOKwjD",
    
);
//База
$db = "bot_health_vision_feb";
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







