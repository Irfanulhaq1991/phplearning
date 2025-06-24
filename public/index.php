<?php
declare(strict_types = 1);
require_once __DIR__."/../vendor/autoload.php";
use Irfan\Phplearning\App;


$app = require_once __DIR__ . '/../src/config/di-config.php';

if ($app instanceof App) {
    $app->start();
} else {
    echo "Failed to initialize the application.";
}

