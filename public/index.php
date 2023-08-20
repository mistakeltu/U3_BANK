<?php

use Bank\App;

session_start();
define('ROOT', __DIR__ . '/../');
define('URL', 'http://u3bank.test/');

require_once '../vendor/autoload.php';

echo App::start();
