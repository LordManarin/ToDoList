<?php
namespace Source\Middlewares;
use Tuupola\Middleware\JwtAuthentication;

class TokenAuthentication{
function tokenAuthentication(){
    return new JwtAuthentication([
        "secret" => getenv('JWT_PASS'),
        "attribute"=>"jwt"]);
}}
