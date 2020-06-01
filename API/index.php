<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;
use Source\Infrastructure\Middlewares;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/Infrastructure/DAO/Bootstrap.php";
require __DIR__ . "/src/Domain/Controllers/Tasks.php";
require __DIR__ . "/src/Domain/Models/Validations.php";
require __DIR__ . "/src/Infrastructure/Middlewares/TokenAuthentication.php";
require __DIR__ . "/src/Infrastructure/Middlewares/BasicAuthentication.php";

session_start();
Bootstrap::start();

$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$config = new Container($config);
$app = new App($config);

$app->post('/login', function (Request $request, Response $response, $next) {
    (new Source\Domain\Controllers\TokenJwt)->generateToken($request, $response);
})->add((new Source\Middlewares\BasicAuthentication())->basicAuthentication());

$app->group('/painel', function () use ($app) {
    $app->post('/posta', function (Request $request, Response $response) {
        (new Source\Domain\Controllers\Tasks)->postTasks();
    });
    $app->put('/atualiza', function (Request $request, Response $response) {
        (new Source\Domain\Controllers\Tasks)->updateTask();
    });
    $app->delete('/deleta', function (Request $request, Response $response) {
        (new Source\Domain\Controllers\Tasks)->deleteTask();
    });
    $app->get('/exibe', function (Request $request, Response $response) {
        (new Source\Domain\Controllers\Tasks)->showTasks();
    });
})->add((new Source\Middlewares\TokenAuthentication)->tokenAuthentication());


$app->run();