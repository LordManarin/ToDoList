<?php
namespace Source\Controllers;
use Source\Models\Usuarios;
use Tuupola\Middleware\HttpBasicAuthentication;

class AutenticaBasico{
    function AutenticaBasico(){

        // captura as query usuario e senha
        $usuario = filter_input(INPUT_GET, "usuario");
        $senha = filter_input(INPUT_GET, "senha");

        //$usuario   = $_SERVER['PHP_AUTH_USER'];
        // $senha = $_SERVER['PHP_AUTH_PW'];

        // puxa o usuario, senha e Id do banco de dados
        $verificaUsuario = Usuarios::where('usuario', '=', $usuario)->value("usuario");
        $verificaSenha = Usuarios::where('usuario', '=', $usuario)->value("senha");
        $_SESSION['ID'] = Usuarios::where('usuario', '=', $usuario)->value("usuario_id");
        $_SESSION['Nome'] = Usuarios::where('usuario', '=', $usuario)->value("nome");
        $_SESSION['Usuario'] = $usuario;

        //verifica se o usuario e senha são compativeis
        if ($senha == $verificaSenha && $usuario == $verificaUsuario) {
            header("HTTP/1.1 200 Success");
            // caso sejam compativeis, define o usuario e senha da autenticacao HTTP basica e prossegue para a rota
            return new httpBasicAuthentication([

                    "users" => [
                        "$usuario" => "$senha",
                        "root" => "teste"
                    ],
                    // caso o usuario informe uma senha de autenticacao basica diferente da do usuario, informa este erro
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
            // caso usuario e senha nao sejam compativeis, informa este erro
            header("HTTP/1.1 401 OK");
            echo json_encode(array("response" => "Este usuario não existe no sistema"));
            exit;

        }
    }
}



