<?php
use AmoCRM\Client\AmoCRMApiClient;

include_once __DIR__ . '/vendor/autoload.php';


$clientId = "25c52dd8-17f8-4078-a1f7-3823a95e9d12";
$clientSecret = "YJKfT7whioud5nTuThnYFvcnG5nUxi2WZnc9E4OqQQkey6ilVU3pJgS04T5OZVRs";
$redirectUri = "https://fomyx.ru/hoteldelta/get_token.php";

$apiClient = new AmoCRMApiClient($clientId, $clientSecret, $redirectUri);

include_once 'token_actions.php';
include_once 'error_printer.php';