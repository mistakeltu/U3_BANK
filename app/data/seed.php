<?php

use Faker\Factory as Faker;

require_once __DIR__ . '/../../vendor/autoload.php';

$faker = Faker::create();


$list = [];

for ($i = 0; $i < 2; $i++) {
    $list[] = [
        'id' => rand(1000000000, 9999999999),
        'personalCode' => rand(1, 6) . rand(1, 999999) . rand(1, 999) . rand(1, 9),
        'firstName' => $faker->word,
        'lastName' => $faker->word,
        'accNumber' => 'LT' . rand(1, 999999999999999999),
        'money' => 0
    ];
}

$list = json_encode($list);

file_put_contents(__DIR__ . '/bankas.json', $list);

echo 'Done' . PHP_EOL;
