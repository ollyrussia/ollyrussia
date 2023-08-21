<?php
header('Access-Control-Allow-Origin:*');
$file = fopen("db_timeout.txt", "r");
$data = array();
while (!feof($file)) {
    $line = trim(fgets($file));
    if (!empty($line)) {
        $parts = explode(">", $line);
        $city = $parts[0];
        $count = intval($parts[2]);
        if (isset($data[$city])) {
            $data[$city] += $count;
        } else {
            $data[$city] = $count;
        }
    }
}
fclose($file);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>
