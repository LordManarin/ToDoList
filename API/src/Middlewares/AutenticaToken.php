<?php
namespace Source\Controllers;
use Tuupola\Middleware\JwtAuthentication;

class AutenticaToken{
function AutenticaToken(){
    //$jwt = $_SESSION['token'];
    //print $jwt;
    return new JwtAuthentication([
        "secret" => "abcde",
        "attribute"=>"jwt"]);
}}
