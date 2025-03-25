<?php

use App\Core\App;
use App\Models\User;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$user = new User();

require '../app/core/init.php';

$app = new App();
$app->loadController();