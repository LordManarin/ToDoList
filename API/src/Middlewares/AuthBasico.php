<?php
namespace Source\Controllers;
require __DIR__."/../../bootstrap.php";
use Source\Models\Usuarios;
use Tuupola\Middleware\HttpBasicAuthentication;

function AuthBasico()
{
    $usuario   = filter_input(INPUT_GET, "usuario");
    $senha = filter_input(INPUT_GET, "senha");
    $verifica = Usuarios::where('usuario', '=', $usuario, 'AND', 'senha', '=', $senha)->value("usuario");
    $usuarioId = Usuarios::where('usuario', '=', $usuario, 'AND', 'senha', '=', $senha)->value("usuario_id");
    $_SESSION['ID']= $usuarioId;

    if($verifica) {
        return new httpBasicAuthentication([
            "users" => [
                "root" => "teste"
            ],
            "error" => function ($response) {
                $body = $response->getBody();
                $body->write(json_encode(array("response" => "Usuario ou senha incorretos")));
                return $response->withBody($body);
        }]);
    }else{
        header("HTTP/1.1 400 BAD REQUEST");
        echo json_encode(array("response"=>"Nenhum dado informado"));
        exit;
    }
}



