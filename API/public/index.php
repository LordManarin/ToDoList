<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;
use function Source\Controllers\AuthBasico;

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../src/Controllers/AcoesTarefas.php";
require __DIR__ . "/../src/Models/Validations.php";
require __DIR__ . "/../src/Middlewares/AuthToken.php";
require __DIR__ . "/../src/Middlewares/AuthBasico.php";

session_start();

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$configuracao = new Container($configuration);
$app = new App($configuracao);

$app->post('/login', function (Request $request, Response $response) {
    (new Source\Controllers\TokenJwt)->GerarToken();
  })->add(AuthBasico());

$app->group('', function () use ($app) {
    $app->get('/exibe', function (Request $request, Response $response) {
        (new Source\Controllers\AcoesTarefas)->exibe();
    });
    $app->post('/posta', function (Request $request, Response $response) {
        (new Source\Controllers\AcoesTarefas)->cria();
    });
    $app->put('/atualiza', function (Request $request, Response $response) {
        (new Source\Controllers\AcoesTarefas)->atualiza();
    });
    $app->delete('/deleta', function (Request $request, Response $response) {
        (new Source\Controllers\AcoesTarefas)->deleta();
    });
})->add(AuthToken());

$app->run();