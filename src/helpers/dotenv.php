<?php

// require_once(__DIR__ . "/vendor/autoload.php");
require_once("vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();
