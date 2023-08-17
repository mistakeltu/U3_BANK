<?php

use Bank\App;

define('ROOT', __DIR__ . '/../');
define('URL', 'http://u3bank.test/');

require_once '../vendor/autoload.php';

echo App::start();
