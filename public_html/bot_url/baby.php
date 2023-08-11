
<?
//Бот распределятор ссылок / ДЕТИ

include_once "Telegram.php";

define('WP_USE_THEMES', false);
require('../wp-blog-header.php');


/*---------------------------------------------------------*/
//Настройки для бота

//Токен бота
$telegram = new Telegram('1190277654:AAHYY3Y70BRcy9mZpUSjAKcnqTR-Xh5KIh8');
//Ссылки

$links = array(
    0=>"https://t.me/joinchat/HrsT_lXhNdTrn8r6EP8zJA",
    1=>"https://t.me/joinchat/HrsT_lVB5-D10pzKw9KVUA",
    2=>"https://t.me/joinchat/HrsT_lOE1X4GybfZvSfA2g",
    3=>"https://t.me/joinchat/HrsT_lWI1vwP1lFU6EHHSQ",
    4=>"https://t.me/joinchat/HrsT_kXR-FW8cZp0euslwA",
    5=>"https://t.me/joinchat/HrsT_kSijVYj0sTDGWhI1g",
    6=>"https://t.me/joinchat/LT6Rv1WmQOKyeINJLH9OxQ",
    7=>"https://t.me/joinchat/LT6Rv0l0gcRFn9o2vlz7BA",
    8=>"https://t.me/joinchat/LT6RvxmrYL6bsRyN57MyPQ",
    9=>"https://t.me/joinchat/HrsT_hzPh3HfMN3o01b3xQ",
    10=>"https://t.me/joinchat/HrsT_hhpl1A6icX4Lml4lw",
    
);
//База
$db = "bot_health_baby";
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







