<?php
namespace Source\Controllers;
use Tuupola\Middleware\JwtAuthentication;

class TokenAuthentication{
function TokenAuthentication(){
    //$jwt = $_SESSION['token'];
    //print $jwt;
    return new JwtAuthentication([
        "secret" => "abcde",
        "attribute"=>"jwt"]);
}}
