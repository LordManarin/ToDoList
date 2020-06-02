<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Dotenv\Dotenv;

class Bootstrap{

    public static function start()
    {     
        self::loadEnv();
        self::connect();
    }

    public static function loadEnv()
   {
        $dotenv = Dotenv::create(__DIR__ . "/../../../");
        $dotenv->load();
   }
    public static function connect()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => getenv('DB_HOST'),
            "port" => getenv('DB_PORT'),
            'database' => getenv('DB_NAME'),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}

