<?php

namespace Bank\Controllers;

use Bank\App;
use Bank\DB\File;

class BankController
{
    public function index()
    {
        $c = new File('bankas');

        return App::view('bank/list', [
            'pageTitle' => 'Bank list'
        ]);
    }

    public function create()
    {
        return App::view('bank/create', [
            'pageTitle' => 'Create new user'
        ]);
    }
}
