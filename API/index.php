<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;
use Source\Controllers\AcoesTarefas;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/bootstrap.php";
require __DIR__ . "/src/Controllers/AcoesTarefas.php";
require __DIR__ . "/src/Models/Validations.php";

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new Container($configuration);
$app = new App($c);

$app->get('/', function (Request $request, Response $response) {
    (new Source\Controllers\AcoesTarefas)->exibe();
});
$app->post('/', function (Request $request, Response $response) {
    (new Source\Controllers\AcoesTarefas)->cria();
});
$app->put('/', function (Request $request, Response $response) {
    (new Source\Controllers\AcoesTarefas)->atualiza();
});
$app->delete('/', function (Request $request, Response $response) {
    (new Source\Controllers\AcoesTarefas)->deleta();
});

$app->run();