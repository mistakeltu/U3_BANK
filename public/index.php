<?php

use Bank\App;

session_start();
define('ROOT', __DIR__ . '/../');
define('URL', 'http://u3bank.test/');

require '../app/functions.php';
require '../vendor/autoload.php';

echo App::start();
