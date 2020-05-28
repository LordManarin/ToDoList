<?php
namespace Source\Controllers;
use Source\Models\Usuarios;
use Tuupola\Middleware\HttpBasicAuthentication;

class AutenticaBasico{
    function AutenticaBasico(){

        $usuario = filter_input(INPUT_GET, "usuario");
        $senha = filter_input(INPUT_GET, "senha");

        //$usuario   = $_SERVER['PHP_AUTH_USER'];
        // $senha = $_SERVER['PHP_AUTH_PW'];

        $verificaUsuario = Usuarios::where('usuario', '=', $usuario)->value("usuario");
        $verificaSenha = Usuarios::where('usuario', '=', $usuario)->value("senha");
        $_SESSION['ID'] = Usuarios::where('usuario', '=', $usuario)->value("usuario_id");
        $_SESSION['Nome'] = Usuarios::where('usuario', '=', $usuario)->value("nome");
        $_SESSION['Usuario'] = $usuario;

        if ($senha == $verificaSenha && $usuario == $verificaUsuario) {
            header("HTTP/1.1 200 Success");
            return new httpBasicAuthentication([

                    "users" => [
                        "$usuario" => "$senha",
                        "root" => "teste"
                    ],
                    "error" => function ($response) {
                        $body = $response->getBody();
                        $body->write(json_encode(array("response" => "Autenticação invalida")));
                        return $response->withBody($body);
                    }]
            );

        } elseif ($senha != $verificaSenha) {
            header("HTTP/1.1 401 OK");
            echo json_encode(array("response" => "Senha incorreta"));
            exit;
        } elseif ($usuario != $verificaUsuario) {
            header("HTTP/1.1 401 OK");
            echo json_encode(array("response" => "Este usuario não existe no sistema"));
            exit;

        }
    }
}



