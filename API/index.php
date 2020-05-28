<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/Infrastructure/bootstrap.php";
require __DIR__ . "/src/Controllers/Tasks.php";
require __DIR__ . "/src/Domain/Models/Validations.php";
require __DIR__ . "/src/Infrastructure/Middlewares/TokenAuthentication.php";
require __DIR__ . "/src/Infrastructure/Middlewares/BasicAuthentication.php";
session_start();
$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$config = new Container($config);
$app = new App($config);

$app->post('/login', function (Request $request, Response $response, $next) {
   (new Source\Controllers\TokenJwt)->GenerateToken();
})->add((new Source\Controllers\BasicAuthentication())->BasicAuthentication());

$app->group('/painel', function () use ($app) {
    $app->get('/exibe', function (Request $request, Response $response) {
        (new Source\Controllers\Tasks)->ShowTasks();
    });
    $app->post('/posta', function (Request $request, Response $response) {
        (new Source\Controllers\Tasks)->CreateTasks();
    });
    $app->put('/atualiza', function (Request $request, Response $response) {
        (new Source\Controllers\Tasks)->UpdateTask();
    });
    $app->delete('/deleta', function (Request $request, Response $response) {
        (new Source\Controllers\Tasks)->DeleteTask();
    });
})->add((new Source\Controllers\TokenAuthentication)->TokenAuthentication());

$app->run();