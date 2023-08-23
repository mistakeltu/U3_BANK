<?php

namespace Bank;

use Bank\DB\File;

class Auth
{
    public static function attempt($email, $password): bool //f-ja kuri bando prijungti vartotoja
    {
        $users = (new File('users'))->showAll(); // pasiemam visus userius

        var_dump($users);

        foreach ($users as $acc) {

            var_dump($acc);

            if ($users['email'] == $email && $users['password'] == md5($password)) { //tikrinam ar email ir psw atitinka
                $_SESSION['logged_in'] = true; //ant sesijos uzdedam logged_in
                $_SESSION['user'] = $users; //i sesija irasom userio name
                return true;
            }
        }
        return false;
    }

    public static function check()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            return true;
        }
        return false;
    }

    public static function user()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return null;
    }

    public static function logout()
    {
        $_SESSION['logged_in'] = false;
        unset($_SESSION['user']);
    }
}
