<?php
namespace Source\Controllers;
require __DIR__ . "/../../vendor/autoload.php";
use Firebase\JWT\JWT;
use Tuupola\Middleware\JwtAuthentication;

class TokenJwt{

    function generateToken($request, $response){
        $userId = $_SESSION['ID'];
        $name= $_SESSION["Name"];
        $user = $_SESSION["User"];
        $key = "abcde";
        $tokenPayLoad=[
            "sub"=>$userId,
            "name"=>$user,
        ];
        $token = JWT::encode($tokenPayLoad, $key);
        echo json_encode(array("Nome" => $name, "Id" => $userId, "Token" => $token));
        return $token;
    }
    function decodeToken(){
        $httpHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $tokenParts = explode(" ", $httpHeader);
        $token = $tokenParts[1];
        $key = "abcde";
        $tokenDecoded = JWT::decode($token, $key, array('HS256'));
        return (array) $tokenDecoded;
    }

}