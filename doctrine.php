#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// replace with mechanism to retrieve EntityManager in your app
$entityManager = require __DIR__."/src/config/db-config.php";

$commands = [
    // If you want to add your own custom console commands,
    // you can do so here.
];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);