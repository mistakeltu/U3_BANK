<?php

namespace Bank\Controllers;

use Bank\App;
use Bank\DB\File;

class BankController
{
    public function index()
    {
        //$c = new File('bankas');
        $list = (new File('bankas'))->showAll();

        return App::view('bank/list', [
            'pageTitle' => 'Bank list',
            'list' => $list
        ]);
    }

    public function create()
    {
        return App::view('bank/create', [
            'pageTitle' => 'Create new user'
        ]);
    }

    public function store()
    {

        // $accounts = json_decode(file_get_contents(__DIR__ . '/../data/bankas.json'), 1);

        $account = [
            'id' => uniqid(),
            'personalCode' => $_POST['personalCode'],
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => 0
        ];

        // $accounts[] = $account;

        // usort($accounts, function ($a, $b) {
        //     return strcmp($a['lastName'], $b['lastName']);
        // });

        (new File('bankas'))->create($account);

        return App::redirect('bank');
    }
}
