<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;
use Source\Middlewares\AuthMiddle;
use Tuupola\Middleware\JwtAuthentication;
use function src\AuthBasico;

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../bootstrap.php";
require __DIR__ . "/../src/Controllers/AcoesTarefas.php";
require __DIR__ . "/../src/Models/Validations.php";
require __DIR__ . "/../src/AuthBasico.php";

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$configuracao = new Container($configuration);
$app = new App($configuracao);

$app->post('/login', function (Request $request, Response $response) {

});

$app->post('/token', function (Request $request, Response $response) {
    (new Source\Controllers\TokenJwt)->GerarToken();
});
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
})->add(AuthBasico());

$app->run();