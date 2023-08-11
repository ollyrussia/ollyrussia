<?

require __DIR__ . '/libs/telegram/Telegram.php';

function sendTelegram($chat_id, $text)
{
	$telegram = new Telegram('1098240823:AAGj90cUWk1wawGWx-645Iy6Nn7Qhkd0DHo');
	$content = array('chat_id' => $chat_id, 'text' => $text);
	$telegram->sendMessage($content);
}

function sendTelegramOllyteam($chat_id, $text)
{
	$telegram = new Telegram('5022165823:AAEQsDQgx8OjtoRer4lie2QVODO9k1RIOdQ');
	$content = array('chat_id' => $chat_id, 'text' => $text);
	$telegram->sendMessage($content);
}
	
function sendTelegramSZ($text)
{
	$chat_id[]='5164139857';
	$chat_id[]='687927961';
	
	for ($id=0; $id<count($chat_id); $id++) {
		$telegram = new Telegram('1098240823:AAGj90cUWk1wawGWx-645Iy6Nn7Qhkd0DHo');
		$content = array('chat_id' => $chat_id[$id], 'text' => $text);
		$telegram->sendMessage($content);
	}
}