<?php
namespace Source\Controllers;
require __DIR__ . "/../../vendor/autoload.php";
use Firebase\JWT\JWT;

class TokenJwt{
    function GerarToken(){
        $usuarioId = $_SESSION['ID'];
        $nome= $_SESSION["Nome"];
        $usuario   = $_SESSION["Usuario"];
        $key = "abcde";
        $tokenPayLoad=[
            "sub"=>$usuarioId,
            "name"=>$usuario,
        ];
        $token = JWT::encode($tokenPayLoad, $key);
        $_SESSION['token']= $token;
        echo json_encode(array("Nome" => $nome, "Id" => $usuarioId, "Token" => $token));

    }

}