<?php

namespace Bank\Controllers;

use Bank\App;

class BankController
{
    public function index()
    {
        return App::view('bank/list');
    }
}
