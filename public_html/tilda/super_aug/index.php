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
    'super_1sep'=>"https://t.me/joinchat/xsp2IBXwwugyZDZi",
    'super_8sep'=>"https://t.me/joinchat/_gfz9bzg1F05YzJi",
    'super_15sep'=>"https://t.me/joinchat/7IUb_3EciVE2M2Zi",
    'super_22sep'=>"https://t.me/joinchat/hspuDmdKrl9iMmRi",
    'super_29sep'=>"https://t.me/joinchat/Fk-H20Un2pplNGZi",
    
    'super_1sep_list'=>"https://t.me/joinchat/xsp2IBXwwugyZDZi",
    'super_8sep_list'=>"https://t.me/joinchat/_gfz9bzg1F05YzJi",
    'super_15sep_list'=>"https://t.me/joinchat/7IUb_3EciVE2M2Zi",
    'super_22sep_list'=>"https://t.me/joinchat/hspuDmdKrl9iMmRi",
    'super_29sep_list'=>"https://t.me/joinchat/Fk-H20Un2pplNGZi",
    
    'super_25aug'=>"https://t.me/joinchat/fGGPdjuGb1Q1MDRi",
    'super_25aug_list'=>"https://t.me/joinchat/fGGPdjuGb1Q1MDRi",
    
    'super_6okt'=>"https://t.me/joinchat/vB4iqOBt9OE2YWJi",
    'super_6okt_list'=>"https://t.me/joinchat/vB4iqOBt9OE2YWJi",
    'super_20okt'=>"https://t.me/joinchat/L1_MlauSUfBjMjJi",
    'super_20okt_list'=>"https://t.me/joinchat/L1_MlauSUfBjMjJi",
    'super_3nov'=>"https://t.me/joinchat/Mj_Ko-YptJI0MzMy",
    'super_3nov_list'=>"https://t.me/joinchat/Mj_Ko-YptJI0MzMy",
    'super_17nov'=>"https://t.me/joinchat/tYqOhshpWbtjNjFi",
    'super_17nov_list'=>"https://t.me/joinchat/tYqOhshpWbtjNjFi",
);

	if ($id=="super_sep_list" || $id=="super_sep_active" ){
		$abonement="1";
	} else {
		$abonement="0";
	}

  $SPApiProxy = new SendpulseApi(API_USER_ID, API_SECRET);
  $bookId = '1303203';
	
  $emails = array(
	    array(
	      'email' => $email,
	      'variables' => array(
	        'имя' => $name,
	        'Фамилия' => $surname,
	        'Phone'=> $phone,
	        'url_tg'=>$links[$id],
	        'booking'=>$booking,
	        'abonement'=>$abonement,
	        'id_date' =>$id,
	        
	        
	      ) 
	    )
	  );
	  $SPApiProxy->addEmails($bookId, $emails);
	
	  echo "ok";


?>