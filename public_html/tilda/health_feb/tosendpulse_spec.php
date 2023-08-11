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

//Список ссылок в зависимости от даты
$links = array(
    'curator'=>'https://t.me/joinchat/AAAAAFRCn4BZ3gwjU9R4mw',
    'baby'=>'https://t.me/joinchat/AAAAAFcbe9MooNu8JXzQYQ',
    'back'=>'https://t.me/joinchat/AAAAAFIju4y7dw2ZRKrEdA',
    'vision'=>'https://t.me/joinchat/AAAAAFJ6wr1_4-b2b5Pmnw',
  );
  
if (  isset($_POST['Name']) ){$name=$_POST['Name'];}
if (  isset($_POST['surname']) ){$surname=$_POST['surname'];}
if (  isset($_POST['Phone']) ){$phone=$_POST['Phone'];}
if (  isset($_POST['Email']) ){$email=$_POST['Email'];}
if (  isset($_POST['Продукт']) ){$product=$_POST['Продукт'];}
if (  isset($_POST['id_product']) ){$id_product=$_POST['id_product'];}

  $SPApiProxy = new SendpulseApi(API_USER_ID, API_SECRET);
  $bookId = '1145589';
	
  $emails = array(
	    array(
	      'email' => $email,
	      'variables' => array(
	        'имя' => $name,
	        'Фамилия' => $surname,
	        'link_tg' => $links[$id_product],
	        'Phone'=> $phone,
	        'Продукт'=>$product,
	        'id_product'=>$id_product
	        
	      ) 
	    )
	  );
	  $SPApiProxy->addEmails($bookId, $emails);
	
	  echo "ok";


?>