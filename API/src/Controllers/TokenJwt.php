<?php
namespace Source\Controllers;
require __DIR__ . "/../../vendor/autoload.php";
use Firebase\JWT\JWT;


class TokenJwt{
    function GerarToken(){
        $usuarioId = filter_input(INPUT_GET, "usuario_id");
        $usuario   = filter_input(INPUT_GET, "usuario");
        // chave da aplicacao
        $key = "abcde";
        $tokenPayLoad=[
            "sub"=>$usuarioId,
            "name"=>$usuario,
        ];
        $token = JWT::encode($tokenPayLoad, $key);
        $_SESSION['usuario_Id']= $usuarioId;
        print $token;
    }


}