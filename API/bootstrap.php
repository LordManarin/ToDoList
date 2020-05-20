<?php
require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    "port"=>"3306",
    'database' => 'todolist',
    'username' => 'root',
    'password' => '',
]);
$capsule->bootEloquent();