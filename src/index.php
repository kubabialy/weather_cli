<?php

declare(strict_types=1);

use Theliver\WeatherCli\Formatters\OutputMessageFormatter;

require dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$client = new Theliver\WeatherCli\Cli\Client(
    new OutputMessageFormatter
);
$client->run($argv);
