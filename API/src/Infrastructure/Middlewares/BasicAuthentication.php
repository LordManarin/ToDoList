<?php
namespace Source\Middlewares;
use Source\Infrastructure\DAO\UserHttp;
use Tuupola\Middleware\HttpBasicAuthentication;

class BasicAuthentication{
    public $user;
    public $passwd;

    public function __construct(){
        $httpHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $this->user = (new UserHttp)->getUser($httpHeader);
        $this->passwd = (new UserHttp)->getPasswd($httpHeader);
    }

    function basicAuthentication(){
        $user = $this->user;
        $passwd = $this->passwd;
        $verify = (new UserHttp)->VerifyUser($user,$passwd);
        if ($verify) {
            return new httpBasicAuthentication([
                    "users" => [
                        "$user" => "$passwd",
                        "root"=> "123"
                    ],
                    "error" => function ($response) {
                        $body = $response->getBody();
                        $body->write(json_encode(array("response" => "Autenticação invalida")));
                        return $response->withBody($body);
                    }]);
        }
    }
}
