<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;
use Tuupola\Middleware\JwtAuthentication;

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../src/Controllers/AcoesTarefas.php";
require __DIR__ . "/../src/Models/Validations.php";

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$configuracao = new Container($configuration);
$app = new App($configuracao);

$app->post('/token', function (Request $request, Response $response) {
    (new Source\Controllers\TokenJwt)->GerarToken();
});
$app->get('/exibe', function (Request $request, Response $response) {
    (new Source\Controllers\AcoesTarefas)->exibe();})
    ->add(function ($request, $response, $next){
        $token = $request->getAttribute("jwt");
        $response=$next($request, $response);
        return $response;
    })
    ->add(new JwtAuthentication([
        'secret'=> '123456',
        'attribute' => 'jwt']));
$app->post('/posta', function (Request $request, Response $response) {
    (new Source\Controllers\AcoesTarefas)->cria();
});
$app->put('/atualiza', function (Request $request, Response $response) {
    (new Source\Controllers\AcoesTarefas)->atualiza();
});
$app->delete('/deleta', function (Request $request, Response $response) {
    (new Source\Controllers\AcoesTarefas)->deleta();
});
$app->run();