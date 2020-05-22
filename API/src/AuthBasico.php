<?php
namespace src;
use Tuupola\Middleware\HttpBasicAuthentication;

function AuthBasico(): HttpBasicAuthentication{
    return new httpBasicAuthentication([
        "users"=> [
            "root"=> "teste"
            ],
        "error" => function ($response, $arguments) {
            $data = [];
            $data["response"] = "Usuario e senha incorretos";
            $body = $response->getBody();
            $body->write(json_encode($data, JSON_UNESCAPED_SLASHES));
            return $response->withBody($body);
        }
        ]);

}