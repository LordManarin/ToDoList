<?php
namespace src;
use Tuupola\Middleware\HttpBasicAuthentication;

function AuthBasico(): HttpBasicAuthentication{
    return new httpBasicAuthentication([
        "users"=> [
            "root"=> "teste"
            ]
        ]);
}