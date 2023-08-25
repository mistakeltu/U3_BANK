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
        Messages::add('You have been logged out', 'success');
        return App::redirect('');
    }

    public function showRegister()
    {
        return App::view('auth/register', [
            'pageTitle' => 'Register page',
            'showNav' => true
        ]);
    }

    public function register()
    {
        $errors = false;
        if (!isset($_POST['name']) || strlen($_POST['name']) < 1) {
            Messages::add('Name must be at least 1 characters long', 'danger');
            $errors = true;
        }
        if (!isset($_POST['password']) || strlen($_POST['password']) < 3) {
            Messages::add('Password must be at least 3 characters long', 'danger');
            $errors = true;
        }
        if (!isset($_POST['password2']) || $_POST['password'] != $_POST['password2']) {
            Messages::add('Passwords must match', 'danger');
            $errors = true;
        }
        if (!isset($_POST['personalCode']) || strlen($_POST['personalCode']) <= 10) {
            Messages::add('Personal code must be at least 11 numbers long', 'danger');
            $errors = true;
        }
        if (!isset($_POST['email']) || strlen($_POST['email']) <= 3 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            Messages::add('Email must be valid', 'danger');
            $errors = true;
        }

        if ($errors) {
            flash();
            return App::redirect('register');
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $personalCode = $_POST['personalCode'];

        Auth::register($name, $email, $password, $personalCode);
        Messages::add('You have been registered', 'success');
        return App::redirect('login');
    }
}
