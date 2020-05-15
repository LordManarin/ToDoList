<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . "/../src/config.php";
require __DIR__ ."/../src/Models/Tarefa.php";
require __DIR__ ."/../src/Models/Validations.php";
require __DIR__ ."/../src/Tarefas/ExibeTarefas.php";
require __DIR__ ."/../src/Tarefas/PostaTarefas.php";
require __DIR__ ."/../src/Tarefas/AtualizaTarefas.php";
require __DIR__ ."/../src/Tarefas/DeletaTarefas.php";

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response): Response {
    ExibeTarefa($response);
    return $response;
});

$app->post("/", function(Request $request, Response $response, $args): Response {
    PostaTarefa($response);
    return $response;
});

$app->put("/", function(Request $request, Response $response, $args): Response {
    AtualizaTarefas($response);
    return $response;
});

$app->delete("/", function(Request $request, Response $response, $args): Response {
    DeletaTarefas($response);
    return $response;
});

$app->run();