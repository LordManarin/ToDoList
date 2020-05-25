<?php
namespace Source\Controllers;
require __DIR__."/../../bootstrap.php";
use Source\Models\Usuarios;
use Tuupola\Middleware\HttpBasicAuthentication;

function AuthBasico()
{
    $usuario   = filter_input(INPUT_GET, "usuario");
    $senha = filter_input(INPUT_GET, "senha");
    $verificaUsuario = Usuarios::where('usuario', '=', $usuario)->value("usuario");
    $verificaSenha = Usuarios::where('usuario', '=', $usuario)->value("senha");
    $usuarioId = Usuarios::where('usuario', '=', $usuario)->value("usuario_id");
    $_SESSION['ID']= $usuarioId;

    if($senha==$verificaSenha || $usuario==$verificaUsuario ){
        return new httpBasicAuthentication([
            "users" => [
                "root" => "teste"
            ]]);
    }else{
        header("HTTP/1.1 400 BAD REQUEST");
        echo json_encode(array("response"=>"Usuario ou senha incorretos"));
        exit;
    }
}



