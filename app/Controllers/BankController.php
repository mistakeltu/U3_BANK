<?php

namespace Bank\Controllers;

use Bank\App;
use Bank\DB\File;

class BankController
{
    public function index()
    {
        $c = new File();

        return App::view('bank/list', [
            'pageTitle' => 'Bank list'
        ]);
    }
}
