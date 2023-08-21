<?


//Подключение к базе данных

$mysqli = new mysqli('localhost', 'cf78864_tilda', '2csKb6B5', 'cf78864_tilda');

if ($mysqli->connect_errno) {

  echo "Извините, возникла проблема на сайте";
  echo "Ошибка: Не удалась создать соединение с базой MySQL и вот почему: \n";
  echo "Номер ошибки: " . $mysqli->connect_errno . "\n";
  echo "Ошибка: " . $mysqli->connect_error . "\n";
  exit;
}


//Функция получения значения счетчика
function Get_counter()
{
  global $mysqli;

  $sql = "SELECT * FROM `bachata_19`";

    if (!$result = $mysqli->query($sql)) 
    {
      echo "Запрос: " . $sql . "\n";
      echo "Номер ошибки: " . $mysqli->errno . "\n";
      echo "Ошибка: " . $mysqli->error . "\n";
      exit;
    }

    if ($result->num_rows === 0) 
    {
      echo "Результатов нет. Пожалуйста, попробуйте еще раз.";
      exit;
    }

  $row = $result->fetch_assoc();
  return $row['counter'];
}


//Изменение значения счетчика
function Add_counter()
{
  global $mysqli;
  
  $sql = "UPDATE `bachata_19` SET `counter` = `counter` + 1";

    if (!$result = $mysqli->query($sql)) 
    {
      echo "Запрос: " . $sql . "\n";
      echo "Номер ошибки: " . $mysqli->errno . "\n";
      echo "Ошибка: " . $mysqli->error . "\n";
      exit;
    }
}

?>