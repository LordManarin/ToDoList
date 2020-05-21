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
        // payload
        $payload = [
            'exp' => (new DateTime("+2days"))->getTimestamp(),
            'sub' => $usuario,
            'uid' => $usuarioId,
            'name' => $nomeUsuario
        ];
        // encoda pra jsono payload

        $payload = json_encode($payload);

        $token = JWT::encode($payload,getenv('JWT_SECRET_KEY'));

        print $token;
    }
}