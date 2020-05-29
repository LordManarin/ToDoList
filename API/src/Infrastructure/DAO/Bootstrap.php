<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;

class Bootstrap{

    public static function start()
    {
        self::config();
        self::connect();
    }

    private static function config()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    public static function connect()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            "port" => "3306",
            'database' => 'todolist',
            'username' => 'root',
            'password' => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}

