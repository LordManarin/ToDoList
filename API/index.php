<?php
session_start();
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;
use Source\Infrastructure\Middlewares;
use Source\Models\Validations;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/Infrastructure/DAO/bootstrap.php";
require __DIR__ . "/src/Infrastructure/DAO/Tasks.php";
require __DIR__ . "/src/Domain/Models/Validations.php";
require __DIR__ . "/src/Infrastructure/Middlewares/TokenAuthentication.php";
require __DIR__ . "/src/Infrastructure/Middlewares/BasicAuthentication.php";

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$config = new Container($config);
$app = new App($config);

$app->post('/login', function (Request $request, Response $response, $next) {
    (new Source\Controllers\TokenJwt)->generateToken($request, $response);
})->add((new Source\Controllers\BasicAuthentication())->basicAuthentication());

$app->group('/painel', function () use ($app) {
    $app->post('/posta', function (Request $request, Response $response) {
        (new Source\Infrastructure\DAO\Tasks)->postTasks();
    });
    $app->put('/atualiza', function (Request $request, Response $response) {
        (new Source\Infrastructure\DAO\Tasks)->updateTask();
    });
    $app->delete('/deleta', function (Request $request, Response $response) {
        (new Source\Infrastructure\DAO\Tasks)->deleteTask();
    });
    $app->get('/exibe', function (Request $request, Response $response) {
        (new Source\Infrastructure\DAO\Tasks)->showTasks();
    });
})->add((new Source\Middlewares\TokenAuthentication)->tokenAuthentication());


$app->run();