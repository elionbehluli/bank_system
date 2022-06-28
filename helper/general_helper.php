<?php

require __DIR__ . '/../vendor/autoload.php';

// die(__DIR__ . '/../vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

function appLogger($message, $relatedTo)
{

    $logger = new Logger('transaction');

    $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/' . $relatedTo , Logger::DEBUG));

    $logger->info($message);

}