
<?
//Бот распределятор ссылок / КУРАТОР

include_once "Telegram.php";

define('WP_USE_THEMES', false);
require('../../wp-blog-header.php');


/*---------------------------------------------------------*/
//Настройки для бота

//Токен бота
$telegram = new Telegram('1614097655:AAFPzgb0CGqbhgKJ5dO3xgaLWaOPh9LFjOg');

//Ссылки
$links = array(
    0=>"https://t.me/joinchat/BjRk7gtknaIzZWNi",
    1=>"https://t.me/joinchat/-s8lpqsNoVIzZWYy",
    2=>"https://t.me/joinchat/3E7KZNMv01Y4OGMy",
    3=>"https://t.me/joinchat/DQNq7J0FxKJlMzdi",
	4=>"https://t.me/joinchat/wct2reE9zJljOTRi",
	5=>"https://t.me/joinchat/diEOCUk_xC9hYjBi",
	6=>"https://t.me/joinchat/8q68YnbB2Dc1ZTZi",
	7=>"https://t.me/joinchat/ipYlacMwfyU3MzRi",
	8=>"https://t.me/joinchat/ihFYBWZ-SPVkZDky",
	9=>"https://t.me/joinchat/YpCL5GU4DVdjNzg6",
	10=>"https://t.me/joinchat/mKPNNGoK0NswYjFi",
	11=>"https://t.me/joinchat/Qddyqji4JX1lMTM6",
	12=>"https://t.me/joinchat/thWWV2MP-adjMzUy",
	13=>"https://t.me/joinchat/ZKW8raDd1sViMjc6",
	14=>"https://t.me/joinchat/bo7he5qdcckyOWEy",
	15=>"https://t.me/joinchat/BaYsgGircg5lYzRi",
	16=>"https://t.me/joinchat/6X_xMKgdPA4xMTZi",
	17=>"https://t.me/joinchat/Nq5zMFMJWXIxZWIy",
	18=>"https://t.me/joinchat/oCIYsc0Y_JYzYmEy",
	19=>"https://t.me/joinchat/hUa-QH28BS5iYjRi",
	20=>"https://t.me/joinchat/L4OXhxA0iZw2NzBi",
	21=>"https://t.me/joinchat/hLKfob8BOjljNzli",
	22=>"https://t.me/joinchat/VBn71xPfkbJhYWIy",
	23=>"https://t.me/joinchat/ELAQmzf6X0I0ZDQy",
	24=>"https://t.me/joinchat/7qgZ4NIgT7ZhNjky",
	25=>"https://t.me/joinchat/-A898pfhdgRkMjgy",
	26=>"https://t.me/joinchat/dqFyjZWmyYM4MDEy",
	27=>"https://t.me/joinchat/XLK0wJdmXCZkYjgy",
	28=>"https://t.me/joinchat/23naMzGJupQ5ZTgy",
	29=>"https://t.me/joinchat/zGJufbvSTw8wODNi",
	30=>"https://t.me/joinchat/__yC4t9Mm143Njhi",
	31=>"https://t.me/joinchat/AFjRiSSfHVI2ZTYy",
	32=>"https://t.me/joinchat/f5_mdg5Ib_A0NjFi",
	33=>"https://t.me/joinchat/iNlrxWfN5-cxZjli",
	34=>"https://t.me/joinchat/2_V7IbQN6LQ2NGJi",
	35=>"https://t.me/joinchat/yczert6LXYk0NTdi",
	36=>"https://t.me/joinchat/GUYazk-OiSBhYTYy",
	37=>"https://t.me/joinchat/WTJ_v_I-qJEzOWRi",
	38=>"https://t.me/joinchat/p2Snje2c0Zc3MmEy",
	39=>"https://t.me/joinchat/ElYWTjBCA8syNmJi",
	40=>"https://t.me/joinchat/df5nrV_57Fg1ODQy",
	41=>"https://t.me/joinchat/exxU777N6UA5NGUy",
	42=>"https://t.me/joinchat/itSCPHZUpyUxYTVi",
	43=>"https://t.me/joinchat/W4N9N15fX-0zZDVi",
	
	
	
);
//База
$db = "bot_vss_summer_mini";
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







