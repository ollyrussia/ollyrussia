<?php

//Рождение женщины. Цели.
//Передаем заявку в амо и суммируем, если есть оплаты от этого же пользователя

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once('SimpleAmoApi.php');
	
$amoAPI = new SimpleAmoApi();

//Ловим данные из тильды

if (  isset($_POST['Name']) ){$name=$_POST['Name'];}
if (  isset($_POST['Email']) ){$email=$_POST['Email'];}
if (  isset($_POST['payment']) ){$payment=$_POST['payment'];}
if (  isset($_POST['Сумма']) ){$sum_pay=$_POST['Сумма'];}

if( isset($_POST['Phone'])  ) {    
		    $phone = $_POST['Phone']; 
		    $phone = str_replace(array('(', ')', ' ', '-'), '', $phone);
		    if (substr($phone,0,1) == 8) $phone[0] = 7;
	}

if (isset($phone) && isset($email) && isset($sum_pay))

{

//Ищем данную сделку по email и телефону, если есть то обновляем итоговую сумму и добавляем примечание.
$query_email = "query=".$email."&status=34863733";
$query_phone = "query=".$phone."&status=34863733";

$leads_email = $amoAPI->getLeads($query_email);
$leads_phone = $amoAPI->getLeads($query_phone);


if ($leads_email!="" || $leads_phone!="")
{
	if ($leads_email!="" && $leads_phone=="") {$lead = json_decode(json_encode($leads_email),true);}
	if ($leads_email=="" && $leads_phone!="") {$lead = json_decode(json_encode($leads_phone),true);}
	if ($leads_email!="" && $leads_phone!="") {$lead = json_decode(json_encode($leads_email),true);}
	

	$total = $lead['_embedded']['items'][0]['custom_fields'][1]['values'][0]['value'];
	$id_lead = $lead['_embedded']['items'][0]['id'];
	
	$sum = $total + $sum_pay; //Прибаваляем сумму оплаты
	
	$data = array (
		'update' => 
		array (
			0 => 
			array (
				'id' => $id_lead,
				'updated_at' => time(),
				'custom_fields' => 
				array (
					0 => 
					array (
						'id' => '314525',
						'values' => 
						array (
							0 => 
							array (
								'value' => $sum,
							),
						),
					),
				),
			),
		),
	);
	
	$update = $amoAPI->updateLeads($data);
	
	$msg_note = "Поступила оплата: ".$sum_pay." рублей, итоговая оплата обновлена.".PHP_EOL." Данные платежа: ".$payment ;
	
	
	
		$data = array (
		'add' => 
		array (
			0 => 
			array (
				'element_id' => $id_lead,
				'element_type' => "2",
				'text'=> $msg_note,
				'note_type' => "4",
				'created_at' => time(),
				'responsible_user_id' => "5911564",
				'created_by'=> "5911564"
			),
		),
	);
	
	$note = $amoAPI->addNote($data);

}else
//Иначе добавляем новую сделку
{
	$data = array (
		'add' => 
		array (
			0 => 
			array (
				'name' => $name,
				'created_at' => time(),
				'status_id' => '34863733',
				'responsible_user_id' => "5911564",
				'tags' => 'Рождение женщины. Цели',
				'custom_fields' => 
				array (
					0 => 
					array (
						'id' => '314523',
						'values' => 
						array (
							0 => 
							array (
								'value' => 'Рождение женщины. Цели',
							),
						),
					),
					1 => 
					array (
						'id' => '314525',
						'values' => 
						array (
							0 => 
							array (
								'value' => $sum_pay,
							),
						),
					),

				),
			),
		),
	);

	$id_lead = $amoAPI->addLeads($data);
	

	
	//Добавляем контакт
	$data = array (
		'add' => 
		array (
			0 => 
			array (
				'name' => $name,
				'leads_id' => $id_lead,
				'responsible_user_id' => '5911564',
				'custom_fields' => 
				array (
					0 => 
					array (
						'id' => '144463',
						'values' => 
						array (
							0 => 
							array (
								'value' => $phone,
								'enum' => 'WORK',
							),
						),
					),
					1 => 
					array (
						'id' => '144465',
						'values' => 
						array (
							0 => 
							array (
								'value' => $email,
								'enum' => 'WORK',
							),
						),
					),					
				),
			),
		),
	);

	$contanct = $amoAPI->addContacts($data);	
	
	
}

} //

echo "ok";



?>