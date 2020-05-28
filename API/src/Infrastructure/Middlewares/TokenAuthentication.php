<?php
namespace Source\Controllers;
use Tuupola\Middleware\JwtAuthentication;

class TokenAuthentication{
function TokenAuthentication(){
    //$jwt = $_SESSION['Token'];
    //print $jwt;
    //$secret = getenv('JWT_PASS');
    return new JwtAuthentication([
        "secret" => "abcde",
        "attribute"=>"jwt"]);
}}
