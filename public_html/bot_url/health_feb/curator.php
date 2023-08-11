
<?
//Бот распределятор ссылок / КУРАТОР

include_once "Telegram.php";

define('WP_USE_THEMES', false);
require('../../wp-blog-header.php');


/*---------------------------------------------------------*/
//Настройки для бота

//Токен бота
$telegram = new Telegram('1502395510:AAEm_U1ywYVgHA1gS0KdJNp__gA9ZnsIsfw');
//Ссылки

$links = array(
    0=>"https://t.me/joinchat/GzLfHACGuDDRcUZ3",
    1=>"https://t.me/joinchat/R4jVsJJyx5BSOxLy",
    2=>"https://t.me/joinchat/VKr52eJefNFvehQG",
    3=>"https://t.me/joinchat/Vh3K6supIyaW-4aG",
	4=>"https://t.me/joinchat/TrV5TDD0Nthh7n6Z",
	5=>"https://t.me/joinchat/S0EZrt_jbhUbyxmL",
	6=>"https://t.me/joinchat/RslEiwIAi1RJi7ER",
	7=>"https://t.me/joinchat/GCmb0I3gGzvF02r0",
	8=>"https://t.me/joinchat/RuOBlDwuu0qKpBH_",
	9=>"https://t.me/joinchat/HT6Nj4h9Af8tBIO0",
	10=>"https://t.me/joinchat/ScOIjvXrzFSWCqmm",
	11=>"https://t.me/joinchat/RqeRY1qta36wrrbH",
	12=>"https://t.me/joinchat/Rz0pFNcCVM-UR5Rm",
	13=>"https://t.me/joinchat/VH5oTkZ6AI5n920E",
	14=>"https://t.me/joinchat/UtAFTRDpTP6sG2aV",
	15=>"https://t.me/joinchat/S82-hnFwKka5UnPJ",
	16=>"https://t.me/joinchat/WV12jxVYA26-rXJr",
	17=>"https://t.me/joinchat/VMFGg8mBlW1PNydZ",
	18=>"https://t.me/joinchat/EkvVivOj3fAo37t0",
	19=>"https://t.me/joinchat/HiwVg_qG3Ii7JZM-",
	20=>"https://t.me/joinchat/H5P4OLRda4x0b3Nr",
	21=>"https://t.me/joinchat/IIDnFG3E94nxhKKn",
	22=>"https://t.me/joinchat/H3E3lwZdt0Vfm1e_",
	23=>"https://t.me/joinchat/IhtjECP8fGIRdVZT",
	24=>"https://t.me/joinchat/Idto8zomV4GAkgO_",
	25=>"https://t.me/joinchat/HkGRNdLKU5jN8daw",
	26=>"https://t.me/joinchat/H0Wes2gNFPHB0Cyf",

	


);
//База
$db = "bot_health_curator_feb";
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







