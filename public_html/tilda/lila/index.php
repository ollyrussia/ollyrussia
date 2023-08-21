<?

//Скрипт отправки заявки в sendpulse
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//Инициализация SENDPULSE
require_once('../api/sendpulseInterface.php');
require_once('../api/sendpulse.php');

define('API_USER_ID', '770db57e618ab06505042fa780074cf3');
define('API_SECRET', 'dd0215093ffb175ddf3c7b1f8729bfcb');


if (  isset($_POST['Name']) ){$name=$_POST['Name'];}
if (  isset($_POST['surname']) ){$surname=$_POST['surname'];}
if (  isset($_POST['Phone']) ){$phone=$_POST['Phone'];}
if (  isset($_POST['Email']) ){$email=$_POST['Email'];}
if (  isset($_POST['booking']) ){$booking=$_POST['booking'];}
if (  isset($_POST['id']) ){$id=$_POST['id'];}

$links = array(
	'lila_27aug'=>'https://t.me/joinchat/hiWOhI2MqGY1OGIy',
    'lila_28aug'=>'https://t.me/joinchat/gO8sG_8p7MVhMTAy',
    'lila_15sep'=>'https://t.me/joinchat/trs3p0ML6MIwNGY6',
    'lila_22sep'=>'https://t.me/joinchat/N-tLGd5ZZmgyMWZi',
    'lila_2okt'=>'https://t.me/joinchat/gxNVoA-x5sE0ZWQy',
    
    'lila_21sep'=>'https://t.me/joinchat/HjCefkv2T7A0OThi',
    'lila_24sep'=>'https://t.me/joinchat/s8sFvrsddCljNzZi',
    'lila_25sep'=>'https://t.me/joinchat/15-Ad2_pxGFkNThi',
    'lila_28sep'=>'https://t.me/joinchat/-im3tBP9sA43Yjc6',
    
    'lila_5okt'=>'https://t.me/joinchat/-128ZhFUfadjOTQy',
    'lila_7okt'=>'https://t.me/joinchat/-013sPGmMwwyYzRi',
    'lila_15okt'=>'https://t.me/joinchat/E1jPRa0MLLkyNTEy',
    'lila_19okt'=>'https://t.me/joinchat/08HsOPlYGuIwYWYy',
    'lila_22okt'=>'https://t.me/joinchat/eEn0PQrWZ9QxMWEy',
    'lila_25okt'=>'https://t.me/joinchat/0IJkVuZGpG40NGUy',
    'lila_28okt'=>'https://t.me/joinchat/iWLLT0wCj2lkZDcy',
    'lila_29okt'=>'https://t.me/joinchat/qzXT1eAolSs0NTQy',
    
    'lila_11feb'=>'https://t.me/+Vv0ceL_yioc2ZjNi',
    'lila_22feb'=>'https://t.me/+hn4JWRnu1BU0Zjhi',
    'lila_24feb'=>'https://t.me/+gW7yemucWKk5YTQy',
  );

  $SPApiProxy = new SendpulseApi(API_USER_ID, API_SECRET);
  $bookId = '1289187';
	
  $emails = array(
	    array(
	      'email' => $email,
	      'variables' => array(
	        'имя' => $name,
	        'Фамилия' => $surname,
	        'Phone'=> $phone,
	        'url'=>$links[$id],
	        'booking'=>$booking,
	        'id_booking'=>$id
	        
	      ) 
	    )
	  );
	  $SPApiProxy->addEmails($bookId, $emails);
	
	  echo "ok";


?>