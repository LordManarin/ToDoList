<?php
namespace Source\Middlewares;

class AuthMiddle extends Middleware{
    public function __invoke($request, $response, $next){
        if(!$this->container->auth->check()){
            $this->container->flash->addMessage('Por favor, faça login para continuar');
            return $response->withRedirect($this->container->router->pathFor('/login'));
        }
        $response = $next($request, $response);
        return $response;
    }



}
