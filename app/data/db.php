<?php

use Faker\Factory as Faker;

require_once __DIR__ . '/../../vendor/autoload.php';

$faker = Faker::create();

$host = '127.0.0.1';
$db   = 'iguanos';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $options);

for ($i = 0; $i < 10; $i++) {
    $list = [
        'id' => rand(1000000000, 9999999999),
        'personalCode' => rand(1, 6) . rand(1, 999999) . rand(1, 999) . rand(1, 9),
        'firstName' => $faker->word,
        'lastName' => $faker->word,
        'accNumber' => rand(1, 999999999999999999),
        'money' => 0
    ];
    $sql = "
    INSERT INTO bankas (personalCode, firstName, lastName, accNumber, money)
    VALUES (?, ?, ?, ?, ?) 
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$list['personalCode'], $list['firstName'], $list['lastName'], $list['accNumber'], $list['money']]);
}

//roles added
$admins = [
    [
        'id' => 1,
        'name' => 'Karolis',
        'email' => 'karolis@gmail.com',
        'password' => md5('132'),
        'role' => 'admin'
    ],
    [
        'id' => 2,
        'name' => 'Petras',
        'email' => 'petras@gmail.com',
        'password' => md5('123'),
        'role' => 'user'
    ],

];

foreach ($admins as $user) {
    $sql = "
    INSERT INTO users (name, email, password, role)
    VALUES (?, ?, ?, ?) 
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user['name'], $user['email'], $user['password'], $user['role']]);
}

echo 'Done' . PHP_EOL;
