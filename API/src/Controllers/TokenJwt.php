<?php
namespace Source\Controllers;
require __DIR__ . "/../../vendor/autoload.php";
use Firebase\JWT\JWT;
class TokenJwt{
    function generateToken(){
        $userId = $_SESSION['ID'];
        $name= $_SESSION["Name"];
        $user   = $_SESSION["User"];
        $key = "abcde";
        $tokenPayLoad=[
            "sub"=>$userId,
            "name"=>$user,
        ];
        $token = JWT::encode($tokenPayLoad, $key);
        $_SESSION['Token']= $token;
        echo json_encode(array("Nome" => $name, "Id" => $userId, "Token" => $token));

    }

}