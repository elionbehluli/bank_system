<?php

require __DIR__ . '/../vendor/autoload.php';

// die(__DIR__ . '/../vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;

function appLogger($message, $relatedTo)
{

    $rotating = new RotatingFileHandler(__DIR__ . '/../logs/' . $relatedTo, 0, Monolog\Logger::INFO);

    $rotating->setFilenameFormat('{date}-{filename}', 'Y-m-d');

    $logger = new Logger('transaction');

    $logger->pushHandler($rotating);

    $logger->info($message);

}