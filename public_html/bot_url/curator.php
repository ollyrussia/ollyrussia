
<?
//Бот распределятор ссылок / КУРАТОР

include_once "Telegram.php";

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');


/*---------------------------------------------------------*/
//Настройки для бота

//Токен бота
$telegram = new Telegram('1357583778:AAHKHZ70Rn49U68L3agw_IqAA9cR8ydptwQ');
//Ссылки

$links = array(
    0=>"https://t.me/joinchat/HrsT_lX7zI8DUFDLvpSfjQ",
    1=>"https://t.me/joinchat/HrsT_lZXXlOiBMudznl9gA",
    2=>"https://t.me/joinchat/HrsT_lA4QAXQj9L-Wy4RAw",
    3=>"https://t.me/joinchat/HrsT_lY7L9o3aYkErLxblA",
	4=>"https://t.me/joinchat/HrsT_lGqcs2KkQpZ49NI0g",
	5=>"https://t.me/joinchat/HrsT_kZGS5FD1MUWdMYlyQ",
	6=>"https://t.me/joinchat/HrsT_kzj49d0XEAL2iHOWQ",
	7=>"https://t.me/joinchat/LT6Rvx1bD7uGIZ2uCJ0XfA",
	8=>"https://t.me/joinchat/LT6RvxxgXVPDvjohabjPKQ",
	9=>"https://t.me/joinchat/LT6RvxyUvxrsDkmHtRngCQ",
	10=>"https://t.me/joinchat/HrsT_hRBR14YYAwKIXdZpw",
	11=>"https://t.me/joinchat/HrsT_hgBgpFnwwHl9bsgPw",
	12=>"https://t.me/joinchat/LT6Rvxjzlx85KMJUPJAJ7Q",
	13=>"https://t.me/joinchat/LT6Rvx1tLgeEGT28FqgFfA",
	
    
);
//База
$db = "bot_health_curator";
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







