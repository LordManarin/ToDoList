<?php
namespace Source\Controllers;
require __DIR__."/../../bootstrap.php";
use Firebase\JWT\JWT;
use Source\Models\Usuarios;
use Tuupola\Middleware\HttpBasicAuthentication;

function AuthBasico()
{
    //$usuario = $_SERVER['PHP_AUTH_USER'];
    //$senha = $_SERVER['PHP_AUTH_PW'];

   //$verifica = Usuarios::where('usuario', '=', $usuario, 'AND', 'senha', '=', $senha)->value("usuario");
   //$usuarioId = Usuarios::where('usuario', '=', $usuario, 'AND', 'senha', '=', $senha)->value("usuario_id");
    return new httpBasicAuthentication([

        "users"=> [
            "root"=> "teste"
        ],
        "error" => function ($response) {
            $body = $response->getBody();
            $body->write(json_encode(array("response"=>"Usuario ou senha incorretos")));
            return $response->withBody($body);
        }]);


}



