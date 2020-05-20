<?php
namespace Source\Controllers;
require __DIR__. "/../../vendor/autoload.php";
use \Firebase\JWT\JWT;

$header = [
    'typ' => 'JWT',
    'alg'=> 'HS265'
];
$payload = [
    'sub' => 'usuario_id',
    'name' => 'usuario'
];
$header = json_encode($header);
$payload = json_encode($payload);

$header = base64_encode($header);
$payload = base64_encode($payload);

$sign = hash_hmac('sha256', $header . "." . $payload, true);
$sign = base64_encode($sign);

$token = $header . '.' . $payload . '.' . $sign;

print $token;
