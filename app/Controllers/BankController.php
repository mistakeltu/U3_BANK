<?php

namespace Bank\Controllers;

use Bank\App;
use Bank\DB\Storage;
use Bank\DB\File;
use Bank\Messages;

class BankController
{
    public function index()
    {
        //$c = new File('bankas');
        // $list = (new File('bankas'))->showAll();
        $list = Storage::getStorage('bankas')->showAll();

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
        if (!isset($_POST['firstName']) || strlen($_POST['firstName']) < 1) {
            Messages::add('First name must be at least 1 characters long', 'danger');
            $errors = true;
        }
        if (!isset($_POST['lastName']) || strlen($_POST['lastName']) < 1) {
            Messages::add('Last name must be at least 1 characters long', 'danger');
            $errors = true;
        }
        if (!isset($_POST['personalCode']) || strlen($_POST['personalCode']) <= 10) {
            Messages::add('Personal code must be at least 11 numbers long', 'danger');
            $errors = true;
        }

        if ($errors) {
            flash();
            return App::redirect('bank/create');
        }


        $account = [
            // 'id' => rand(1000000000, 9999999999),
            'personalCode' => $_POST['personalCode'],
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => 0
        ];

        Storage::getStorage('bankas')->create($account);

        Messages::add('Account created', 'success');

        return App::redirect('bank');
    }

    public function delete($id)
    {
        //tikrinimas integerio ir stringo
        if (!is_numeric($id) || !is_integer($id + 0)) {
            http_response_code(404);
            return App::viewError('404');
        }

        $user = Storage::getStorage('bankas')->show($id);

        //tikrinimas kad useris nebutu tuscias
        if (!$user) {
            http_response_code(404);
            return App::viewError('404');
        }

        if ($user['money'] < 1) {
            return App::view('bank/delete', [
                'pageTitle' => 'Confirm delete?',
                'user' => $user,
            ]);
        } else {
            Messages::add('Can not be deleted, account has money', 'danger');
            return App::redirect('bank');
        }
    }

    public function destroy($id)
    {
        Storage::getStorage('bankas')->delete($id);

        Messages::add('Account deleted', 'success');

        return App::redirect('bank');
    }

    public function edit($id)
    {
        if (!is_numeric($id) || !is_integer($id + 0)) {
            http_response_code(404);
            return App::viewError('404');
        }

        $user = Storage::getStorage('bankas')->show($id);

        if (!$user) {
            http_response_code(404);
            return App::viewError('404');
        }

        return App::view('bank/edit', [
            'pageTitle' => 'Edit user money',
            'user' => $user,
        ]);
    }

    public function addCard($id)
    {
        $user = Storage::getStorage('bankas')->show($id);

        return App::view('bank/addCard', [
            'pageTitle' => 'Add money',
            'user' => $user,
        ]);
    }

    public function minusCard($id)
    {
        $user = Storage::getStorage('bankas')->show($id);

        return App::view('bank/minusCard', [
            'pageTitle' => 'Subtract money',
            'user' => $user,
        ]);
    }

    public function minusFromAcc($id)
    {
        $user = Storage::getStorage('bankas')->show($id);
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

        Storage::getStorage('bankas')->update($id, $account);

        Messages::add('Money was subtracted from account', 'success');

        return App::redirect('bank');
    }

    public function addToAcc($id)
    {
        $user = Storage::getStorage('bankas')->show($id);

        $account = [
            'id' => rand(1000000000, 9999999999),
            'personalCode' => $user['personalCode'],
            'firstName' => $user['firstName'],
            'lastName' => $user['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => $user['money'] + $_POST['add'],
        ];

        Storage::getStorage('bankas')->update($id, $account);

        Messages::add('Money was added to account', 'success');

        return App::redirect('bank');
    }

    public function update($id)
    {

        $errors = false;
        if (!isset($_POST['firstName']) || strlen($_POST['firstName']) < 1) {
            Messages::add('First name must be at least 1 characters long', 'danger');
            $errors = true;
        }
        if (!isset($_POST['lastName']) || strlen($_POST['lastName']) < 1) {
            Messages::add('Last name must be at least 1 characters long', 'danger');
            $errors = true;
        }
        if (!isset($_POST['personalCode']) || strlen($_POST['personalCode']) <= 10) {
            Messages::add('Personal code must be at least 11 numbers long', 'danger');
            $errors = true;
        }

        if ($errors) {
            flash();
            return App::redirect('bank/create');
        }

        $account = [
            'id' => rand(1000000000, 9999999999),
            'personalCode' => $_POST['personalCode'],
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'accNumber' => 'LT' . rand(1, 999999999999999999),
            'money' => $_POST['money'],
        ];

        Storage::getStorage('bankas')->update($id, $account);

        Messages::add('Account edited', 'success');

        return App::redirect('bank');
    }

    public function show($id)
    {
        $user = Storage::getStorage('bankas')->show($id);

        return App::view('bank/show', [
            'pageTitle' => 'Account details',
            'user' => $user,
        ]);
    }
}
