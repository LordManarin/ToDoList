<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Source\Models\Tarefa;
use Source\Models\Validations;

require __DIR__ . '/../vendor/autoload.php';
require "Config.php";
require "Models/Tarefa.php";
require "Models/Validations.php";

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response): Response {
    ExibeTarefa($request, $response);
});

$app->post("/", function(Request $request, Response $response, $args): Response {
    PostaTarefa($request, $response);
});

$app->put("/", function(Request $request, Response $response, $args): Response {
    AtualizaTarefas($request, $response);
});

$app->delete("/", function(Request $request, Response $response, $args): Response {
    DeletaTarefas($request, $response);
});

$app->run();

