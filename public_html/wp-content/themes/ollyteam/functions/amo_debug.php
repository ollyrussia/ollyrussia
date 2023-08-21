<?
require_once ('/home/c/cf78864/Ollyteam.ru/public_html/wp-content/themes/ollyteam/functions/amo.php');

$secret_key="YgdttYUbUltChMeMSukF4rk7y3ySrqNrJPB6nU1cd6x6WtECp6eEX5rUHvoLSUxc";
$intagration_id="6bdbe3cf-e3c0-4e42-9586-c36d9abc6a78";
$client_domen="alarikabox";
$redirect_uri="https://ollyteam.ru/";
$auth_token="def50200242e1b47aa7dc2b2f8826df6b97ee61cbb0e5fe2841e2c34af4db87ba1b99fd2e0f00132d0d5e89c7ec23893dd7a8993d7581f1965879a80c5f1b44222e72b0b3548e8e721ee340075a2c4f566ecd81a28ecaaa357f493fa4abb5f01649a94ca61bfbce9df0262205e972c0202810dbacf617ebccb8954db14c98575f78e112112b0dc234a903a708814410f665b9728ff6ed8d42e9d800d25569ffa1facf585e337246d22ed3cd926428298d1f4d48feaec3bf426299b7089c89e8cc540ba28049d22615b84ad6b3158c4981b84a0a6053931581007a2b342e1dc5b36076593a46bd721a1e7b9d3ff5237e48db0a2e3d347d8feb5c94ab09ba21dd778e0b548514c468190ec0c05ba0f3e0b9a364501628a075c285f3c42d58fd4e4f16b12716a052e335e0b4c1af3034dcac56954992d379a19469545fdcd747a64c1504b92ace49393bda21c554dc9283f06eb2c654d07c24b9588aefd7b715c3351b10354d218fd72696ddf13772197162352d3b5a9cf2c22d9f8a588a1785827c8742aa102638554ec035a817fc77d2c814cef39e4afd3879bee9e9ab798cf81c99854839ff7448268e1ebfaa02b73b31a1be12a64d20457accedb0664e8440334e8424e28c3f397b8f1e4e21fff439369bb8733c0f20fa497a2ed12ca53cf6879f6eda9a2";

file_put_contents('/home/c/cf78864/Ollyteam.ru/public_html/wp-content/themes/ollyteam/functions/amo_debug.log', date('Y-m-d H:i:s')." Дебаг ".'========================================================'."\n", FILE_APPEND | LOCK_EX);

$amocrm = new EbClientAmocrm($secret_key, $intagration_id, $client_domen, $redirect_uri, $auth_token);

// Делаем контрольный запрос для проверки аксес токен и его обновления

$contact_test = $amocrm->get_contacts_by_pnone("+380681952162");
var_dump($contact_test);
file_put_contents('/home/c/cf78864/Ollyteam.ru/public_html/wp-content/themes/ollyteam/functions/amo_debug.log', date('Y-m-d H:i:s')." Проверка аксес токен: ".json_encode($contact_test, JSON_UNESCAPED_UNICODE)."\n", FILE_APPEND | LOCK_EX);
exit;


?>