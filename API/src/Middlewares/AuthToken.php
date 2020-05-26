<?php

use Tuupola\Middleware\JwtAuthentication;

function AuthToken(){
    return new JwtAuthentication([
        "token" => $_SESSION['token'],
        "secret" => "abcde",
        "attribute"=>"jwt"]);
}
