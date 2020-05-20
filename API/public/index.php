<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

require __DIR__ . '/vendor/autoload.php';

$app = new App;

/* EXIBE AS TAREFAS FILTRANDO COM BASE NO usuario_id */
$app->get('/', function (Request $request, Response $response): Response {
    ExibeTarefas($response);
    return $response;
});
/* INSERE UMA TAREFA NOVA */
$app->post("/", function (Request $request, Response $response, $args): Response {
    PostaTarefa($response);
    return $response;
});
/* ATUALIZA UMA TAREFA EXISTENTE*/
$app->put("/", function (Request $request, Response $response, $args): Response {
    AtualizaTarefas($response);
    return $response;
});
/* DELETA UMA TAREFA EXISTENTE*/
$app->delete("/", function (Request $request, Response $response, $args): Response {
    DeletaTarefas($response);
    return $response;
});

$app->run();