<?php
namespace Source\Controllers;
require __DIR__."/../../bootstrap.php";
use Firebase\JWT\JWT;
use Source\Models\Usuarios;

function AuthBasico()
{
    $usuario = $_SERVER['PHP_AUTH_USER'];
    $senha = $_SERVER['PHP_AUTH_PW'];

    $verifica = Usuarios::where('usuario', '=', $usuario, 'AND', 'senha', '=', $senha)->value("usuario");
    $usuarioId = Usuarios::where('usuario', '=', $usuario, 'AND', 'senha', '=', $senha)->value("usuario_id");

    if (!$verifica) {
        header("HTTP/1.1 200 Ok");
        echo json_encode(array("response" => "Senha Incorreta"));
        exit;
    } else {
        header("HTTP/1.1 200 Ok");
        $key = "abcde";
        $tokenPayLoad=[
            "sub"=>$usuarioId,
            "name"=>$usuario,
        ];
        $token = JWT::encode($tokenPayLoad, $key);
        $_SESSION['token']= $token;
        print $token;
    }
}



