<?php
namespace src;
use Tuupola\Middleware\HttpBasicAuthentication;

function AuthBasico(): HttpBasicAuthentication{
    return new httpBasicAuthentication([
        "users"=> [
            "root"=> "teste"
            ],
        "error" => function ($response, $arguments) {
            $body = $response->getBody();
            $body->write(json_encode(array("response"=>"Usuario ou senha incorretos")));
            return $response->withBody($body);
        }
        ]);

}