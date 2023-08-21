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


        $account = [
            'id' => uniqid(),
            'personalCode' => $_POST['personalCode'],
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => 0
        ];

        (new File('bankas'))->create($account);

        return App::redirect('bank');
    }
}
