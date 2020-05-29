<?php
namespace Source\Controllers;
use Source\Domain\Models\Users;
use Tuupola\Middleware\HttpBasicAuthentication;

class BasicAuthentication{
    function basicAuthentication(){

        $user = filter_input(INPUT_GET, "usuario");
        $passwd = filter_input(INPUT_GET, "senha");

        //$usuario   = $_SERVER['PHP_AUTH_USER'];
        // $senha = $_SERVER['PHP_AUTH_PW'];

        $verifyUser = Users::where('user', '=', $user)->value("user");
        $verifyPasswd = Users::where('user', '=', $user)->value("passwd");
        $_SESSION['ID'] = Users::where('user', '=', $user)->value("user_id");
        $_SESSION['Name'] = Users::where('user', '=', $user)->value("name");
        $_SESSION['User'] = $user;

        if ($passwd == $verifyPasswd && $user== $verifyUser) {
            return new httpBasicAuthentication([

                    "users" => [
                        "$user" => "$passwd",
                        "root" => "teste"
                    ],
                    "error" => function ($response) {
                        $body = $response->getBody();
                        $body->write(json_encode(array("response" => "Autenticação invalida")));
                        return $response->withBody($body);
                    }]
            );

        } elseif ($passwd!= $verifyPasswd) {
            echo json_encode(array("response" => "Senha incorreta"));
            exit;
        } elseif ($user != $verifyUser) {
            echo json_encode(array("response" => "Este usuario não existe no sistema"));
            exit;

        }
    }
}



