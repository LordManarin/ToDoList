<?php


namespace Source\Models;
use Illuminate\Database\Capsule\Manager as Capsule;


class Database {

    function __construct() {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'todolist',
            'username' => 'root',
            'password' => '',
        ]);
        // Setup the Eloquent ORM…
        $capsule->bootEloquent();
    }

}
