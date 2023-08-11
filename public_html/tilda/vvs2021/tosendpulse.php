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
if (  isset($_POST['Продукт']) ){$product=$_POST['Продукт'];}
if (  isset($_POST['id_product']) ){$id_product=$_POST['id_product'];}

  $SPApiProxy = new SendpulseApi(API_USER_ID, API_SECRET);
  $bookId = '1173188';
	
  $emails = array(
	    array(
	      'email' => $email,
	      'variables' => array(
	        'имя' => $name,
	        'Фамилия' => $surname,
	        'Phone'=> $phone,
	        'Продукт'=>$product,
	        'id_product'=>$id_product
	        
	      ) 
	    )
	  );
	  $SPApiProxy->addEmails($bookId, $emails);
	
	  echo "ok";


?>