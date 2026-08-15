<?php


require 'vendor/autoload.php';

use App\Bootstrap\Application;

use function Tests\runTest;

runTest();

$app = new Application();
$app->run();
