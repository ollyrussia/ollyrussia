<?

require('../wp-blog-header.php');
	
include_once "Telegram.php";
$telegram = new Telegram('1098240823:AAGj90cUWk1wawGWx-645Iy6Nn7Qhkd0DHo');



$id_teg = array(759075263,515576830,361093437,637596662,228144287,655279740,683460222,479938005,341165213,330839503,353068727,751339609,278230442,768166238,283666124,183330059,402865877);

$message_telegram = "Напоминаю, сегодня нужно обновить свободные окна на сайте.";

foreach ($id_teg as $id) 
{
    $content = array('chat_id' => $id, 'text' => $message_telegram);
	$telegram->sendMessage($content);
}



?>