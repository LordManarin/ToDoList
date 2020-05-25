<?php
namespace Source\Controllers;
use Tuupola\Middleware\HttpBasicAuthentication;

    function AuthBasico(): HttpBasicAuthentication{
        return new httpBasicAuthentication([
            "users"=> [
                "Rafael"=> "teste"
            ],
            "error" => function ($response) {
                $body = $response->getBody();
                $body->write(json_encode(array("response"=>"Usuario ou senha incorretos")));
                return $response->withBody($body);
            }]);

};
/*
function AuthBasico(): HttpBasicAuthentication{
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $connect = mysqli_connect('localhost','root','', "todolist");
    $verifica = mysqli_query($connect,"SELECT * FROM usuarios WHERE usuario ='$usuario' AND senha = '$senha'") or die("erro ao realizar o login");
        if (!$verifica) {
            header("HTTP/1.1 400 BAD REQUEST");
            echo json_encode(array("response" => "Usuario ou senha incorretos"));
            die();
        } else {
            return new httpBasicAuthentication([
                "users" => [
                    "$usuario" => "$senha"
                ]]);
        }
}
*/
