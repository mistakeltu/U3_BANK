<?php

namespace Bank\Controllers;

use Bank\App;
use Bank\DB\File;
use Bank\Messages;

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

        $errors = false;
        if (!isset($_POST['firstName']) || strlen($_POST['firstName']) < 3) {
            // Messages::add('Donut title must be at least 3 characters long', 'danger');
            $errors = true;
        }
        if (!isset($_POST['lastName']) || strlen($_POST['lastName']) < 3) {
            // Messages::add('Donut description must be at least 3 characters long', 'danger');
            $errors = true;
        }
        if (!isset($_POST['personalCode']) || strlen($_POST['personalCode']) <= 10) {
            // Messages::add('Donut description must be at least 3 characters long', 'danger');
            $errors = true;
        }

        if ($errors) {
            // flash();
            return App::redirect('bank/create');
        }


        $account = [
            'id' => rand(1000000000, 9999999999),
            'personalCode' => $_POST['personalCode'],
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => 0
        ];

        (new File('bankas'))->create($account);

        Messages::add('Account created', 'success');

        return App::redirect('bank');
    }

    public function delete($id)
    {
        $user = (new File('bankas'))->show($id);

        if ($user['money'] < 1) {
            return App::view('bank/delete', [
                'pageTitle' => 'Confirm delete?',
                'user' => $user,
            ]);
        } else {
            return App::redirect('bank');
        }
    }

    public function destroy($id)
    {
        (new File('bankas'))->delete($id);

        Messages::add('Account deleted', 'success');

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

    public function addCard($id)
    {
        $user = (new File('bankas'))->show($id);

        return App::view('bank/addCard', [
            'pageTitle' => 'Add money',
            'user' => $user,
        ]);
    }

    public function minusCard($id)
    {
        $user = (new File('bankas'))->show($id);

        return App::view('bank/minusCard', [
            'pageTitle' => 'Subtract money',
            'user' => $user,
        ]);
    }

    public function minusFromAcc($id)
    {
        $user = (new File('bankas'))->show($id);
        $moneyLeft = $user['money'] - $_POST['minus'];

        if ($moneyLeft < 0) {
            return App::redirect('bank');
        } else {
            $account = [
                'id' => rand(1000000000, 9999999999),
                'personalCode' => $user['personalCode'],
                'firstName' => $user['firstName'],
                'lastName' => $user['lastName'],
                'accNumber' => 'LT' . rand(1, 999999999999999999),
                'money' => $moneyLeft
            ];
        }


        (new File('bankas'))->update($id, $account);
        return App::redirect('bank');
    }

    public function addToAcc($id)
    {
        $user = (new File('bankas'))->show($id);

        $account = [
            'id' => rand(1000000000, 9999999999),
            'personalCode' => $user['personalCode'],
            'firstName' => $user['firstName'],
            'lastName' => $user['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => $user['money'] + $_POST['add'],
        ];

        (new File('bankas'))->update($id, $account);
        return App::redirect('bank');
    }

    public function update($id)
    {

        $account = [
            'id' => rand(1000000000, 9999999999),
            'personalCode' => $_POST['personalCode'],
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => $_POST['money'],
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
