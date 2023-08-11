
<?
//Бот распределятор ссылок / КУРАТОР

include_once "Telegram.php";

define('WP_USE_THEMES', false);
require('../../wp-blog-header.php');


/*---------------------------------------------------------*/
//Настройки для бота

//Токен бота
$telegram = new Telegram('1333687884:AAHzpcfPRHF_Nhb7koX5oW5pss2zW5G1wHs');

//Ссылки
$links = array(
    0=>"https://t.me/joinchat/HrsT_hwhSo3xpqj1jZ-5Og",
    1=>"https://t.me/joinchat/HrsT_lDtK_bEb7Y2Rm41Qg",
    2=>"https://t.me/joinchat/HrsT_kzA3ydx6Je4IDMvLQ",
    3=>"https://t.me/joinchat/HrsT_k8UhhXhISWnVluZRg",
	4=>"https://t.me/joinchat/HrsT_kRmsFhZAxGO_x_6zw",
	5=>"https://t.me/joinchat/HrsT_lHQtRgjDmYYuUsYgw",
	6=>"https://t.me/joinchat/HrsT_lcf7Z3Tf74_wsuQrA",
	7=>"https://t.me/joinchat/HrsT_lBXciCJeSOXvj9zNg",
	8=>"https://t.me/joinchat/HrsT_k9lrK1P0x3hpuaCeg",
	9=>"https://t.me/joinchat/HrsT_lkGneZW9sNGHq5MTQ",
);
//База
$db = "bot_vss_mini";
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







