<?php
namespace Source\Controllers;
use PDO;
use Tuupola\Middleware\HttpBasicAuthentication;
use Tuupola\Middleware\HttpBasicAuthentication\PdoAuthenticator;
require __DIR__."/../../bootstrap.php";


function AuthBasico(){
   $usuario= $_SERVER['PHP_AUTH_USER'];
   $senha= $_SERVER['PHP_AUTH_PW'];






    /*
     * HttpBasicAuthentication
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=todolist',"root", "");
    return new httpBasicAuthentication([
            "authenticator" => new PdoAuthenticator([
                "pdo" => $pdo,
                "table" => "usuarios",
                "user" => "usuario",
                "hash"=>"senha"
            ])
            ,
            "error" => function ($response) {
                $body = $response->getBody();
                $body->write(json_encode(array("response"=>"Usuario ou senha incorretos")));
                return $response->withBody($body);
            }]);*/

}

