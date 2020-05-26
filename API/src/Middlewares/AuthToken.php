<?php

use Tuupola\Middleware\JwtAuthentication;

function AuthToken(){
    return new JwtAuthentication([

        "secret" => "abcde",
        "attribute"=>"jwt"]);
}
