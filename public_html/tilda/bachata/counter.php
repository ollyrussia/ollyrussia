<?
//Работа с счетчкиком по Расстановкам
header('Content-Type: application/json');

//Подлюкчаемся к базе с счетчиком
require_once ('db.php');

//Выводим значение счетчика

echo Get_counter();



?>