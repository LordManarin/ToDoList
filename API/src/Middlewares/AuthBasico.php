<?php
namespace Source\Controllers;
require __DIR__."/../../bootstrap.php";
require  __DIR__ . "/../Controllers/TokenJwt.php";

use Firebase\JWT\JWT;
use Source\Models\Usuarios;
use Tuupola\Middleware\HttpBasicAuthentication;

function AuthBasico(){

    // captura as query usuario e senha
    $usuario   = filter_input(INPUT_GET, "usuario");
    $senha = filter_input(INPUT_GET, "senha");

    // puxa o usuario, senha e Id do banco de dados
    $verificaUsuario = Usuarios::where('usuario', '=', $usuario)->value("usuario");
    $verificaSenha = Usuarios::where('usuario', '=', $usuario)->value("senha");
    $usuarioId = Usuarios::where('usuario', '=', $usuario)->value("usuario_id");
    $_SESSION['ID']= $usuarioId;

    //verifica se o usuario e senha são compativeis
    if($senha==$verificaSenha && $usuario==$verificaUsuario ){
        header("HTTP/1.1 401 OK");
        // caso sejam compativeis, define o usuario e senha da autenticacao HTTP basica e prossegue para a rota
        return new httpBasicAuthentication([
         "users" => [
             "$usuario" => "$senha",
             "root"=>"teste"
         ],
         // caso o usuario informe uma senha de autenticacao basica diferente da do usuario, informa este erro
            "error" => function ($response) {
                $body = $response->getBody();
                $body->write(json_encode(array("response"=>"Autenticação invalida")));
                return $response->withBody($body);
            }]);
    }else{
        // caso usuario e senha nao sejam compativeis, informa este erro
        header("HTTP/1.1 401 OK");
        echo json_encode(array("response"=>"Usuario ou senha do sistema incorretos"));
        exit;
    }
}



