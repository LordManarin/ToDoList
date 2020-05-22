<?php
namespace Source\Controllers;
require __DIR__ . "/../../vendor/autoload.php";

namespace Source\Controllers;
use DateTime;
use Firebase\JWT\JWT;

class TokenJwt{
    function GerarToken(){
        $usuarioId = filter_input(INPUT_GET, "usuario_id");
        $usuario = filter_input(INPUT_GET, "usuario");
        $nomeUsuario = filter_input(INPUT_GET, "nome");
        // chave da aplicacao
        $key = "123465";
        // cabecalho
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS265'
        ];
        // payload
        $payload = [
            'exp' => (new DateTime("+2days"))->getTimestamp(),
            'sub' => $usuario,
            'uid' => $usuarioId,
            'name' => $nomeUsuario
        ];
        // encoda pra json o header e o payload
        $header = json_encode($header);
        $payload = json_encode($payload);

        // encoda para base 64
        $header = base64_encode($header);
        $payload = base64_encode($payload);

        // assinatura
        $sign = hash_hmac('sha256', $header . "." . $payload, $key, true);
        $sign = base64_encode($sign);

        $token = $header . '.' . $payload . '.'. $sign;
        print $token;
    }

}