<?php
require_once __DIR__. "/src/Controllers/TokenJwt.php";

$token = (new Source\Controllers\TokenJwt())->GerarToken('5','rafael@email.net','Rafael');


