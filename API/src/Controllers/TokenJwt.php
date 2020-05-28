<?php
namespace Source\Controllers;
require __DIR__ . "/../../vendor/autoload.php";
use Firebase\JWT\JWT;

class TokenJwt{
    function GerarToken(){
        // pega o ID do usuario informado na autenticacao basica
        $usuarioId = $_SESSION['ID'];
        $nome= $_SESSION["Nome"];
        $usuario   = $_SESSION["Usuario"];
        // chave da aplicacao
        $key = "abcde";
        // payload com as informacoes do usuario
        $tokenPayLoad=[
            "sub"=>$usuarioId,
            "name"=>$usuario,
        ];
        // gera o token
        $token = JWT::encode($tokenPayLoad, $key);
        // armazena o token em uma sessao
        $_SESSION['token']= $token;
        // imprime para o usuario o seu token
        echo json_encode(array("Nome" => $nome, "Id" => $usuarioId, "Token" => $token));

    }

}