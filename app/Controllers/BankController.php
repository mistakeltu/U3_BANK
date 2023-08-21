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
            'id' => rand(1000000000, 9999999999),
            'personalCode' => $_POST['personalCode'],
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => 0
        ];

        (new File('bankas'))->create($account);

        return App::redirect('bank');
    }

    public function delete($id)
    {
        $user = (new File('bankas'))->show($id);

        return App::view('bank/delete', [
            'pageTitle' => 'Confirm delete?',
            'user' => $user,
        ]);
    }

    public function destroy($id)
    {
        (new File('bankas'))->delete($id);
        return App::redirect('bank');
    }

    public function edit($id)
    {
        $user = (new File('bankas'))->show($id);

        return App::view('bank/edit', [
            'pageTitle' => 'Edit user money',
            'user' => $user,
        ]);
    }

    public function update($id)
    {
        $account = [
            'id' => rand(1000000000, 9999999999),
            'personalCode' => $_POST['personalCode'],
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => $_POST['money']
        ];

        (new File('bankas'))->update($id, $account);
        return App::redirect('bank');
    }

    public function show($id)
    {
        $user = (new File('bankas'))->show($id);

        return App::view('bank/show', [
            'pageTitle' => 'Account details',
            'user' => $user,
        ]);
    }
}
