<?php

namespace Bank\Controllers;

use Bank\App;
use Bank\Auth;
use Bank\Messages;

class LoginController
{
    public function showLogin()
    {
        return App::view('auth/login', [
            'pageTitle' => 'Login page',
            'showNav' => false
        ]);
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (Auth::attempt($email, $password)) {
            return App::redirect('bank');
        } else {
            return App::redirect('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return App::redirect('login');
    }
}
