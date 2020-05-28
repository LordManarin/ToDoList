<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/Infraestrutura/bootstrap.php";
require __DIR__ . "/src/Controllers/AcoesTarefas.php";
require __DIR__ . "/src/Models/Validations.php";
require __DIR__ . "/src/Middlewares/AutenticaToken.php";
require __DIR__ . "/src/Middlewares/AutenticaBasico.php";

session_start();

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$configuracao = new Container($configuration);
$app = new App($configuracao);

$app->post('/login', function (Request $request, Response $response, $next) {
   (new Source\Controllers\TokenJwt)->GerarToken();
})->add((new Source\Controllers\AutenticaBasico())->AutenticaBasico());

$app->group('/painel', function () use ($app) {
    $app->get('/exibe', function (Request $request, Response $response) {
        (new Source\Controllers\AcoesTarefas)->exibeTarefas();
    });
    $app->post('/posta', function (Request $request, Response $response) {
        (new Source\Controllers\AcoesTarefas)->criaTarefas();
    });
    $app->put('/atualiza', function (Request $request, Response $response) {
        (new Source\Controllers\AcoesTarefas)->atualizaTarefas();
    });
    $app->delete('/deleta', function (Request $request, Response $response) {
        (new Source\Controllers\AcoesTarefas)->deletaTarefas();
    });
})->add((new Source\Controllers\AutenticaToken)->AutenticaToken());

$app->run();