<?php

use App\Lib\App;

ini_set('display_errors', 1);

require_once __DIR__ . "/vendor/autoload.php";



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();



(new App(
        $_ENV['DB_HOST'],
        $_ENV['DB_NAME'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
));
