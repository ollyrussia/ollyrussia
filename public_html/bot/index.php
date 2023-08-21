<?
include_once "Telegram.php";
$telegram = new Telegram('1098240823:AAGj90cUWk1wawGWx-645Iy6Nn7Qhkd0DHo');

//Автоответчик с ID
$chat_id = $telegram->ChatID();
$content = array('chat_id' => $chat_id, 'text' => "Приветствую! С помощью этого бота вы будете получать уведомления о новых записях. Добавьте, пожалуйста, вот этот ID: [$chat_id]  в таблицу https://docs.google.com/spreadsheets/d/1AJSe1qeWSeVUuj_0_ILAX7rceHATmmJr4-M0vnmpow8/edit?usp=sharing под своей фамилией");
$telegram->sendMessage($content,'html');



?>