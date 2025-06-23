<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$paths = [__DIR__.'/../model'];
$isDevMode = true;

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => 'mysql',    // service name from docker-compose
    'port'     => 3306,
    'user'     => 'root',     // match your docker-compose MYSQL_USER
    'password' => 'abc', // match MYSQL_PASSWORD
    'dbname'   => 'user_post_db',
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
return new EntityManager($connection, $config);
