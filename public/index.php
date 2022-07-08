<?php

use Dotenv\Dotenv;

require_once(dirname(__DIR__) . "/vendor/autoload.php");

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

require_once(dirname(__DIR__) . "/bootstrap/app.php");
