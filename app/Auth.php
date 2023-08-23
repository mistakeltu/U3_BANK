<?php

namespace Bank;

use Bank\DB\File;

class Auth
{
    public static function attempt($email, $password): bool //f-ja kuri bando prijungti vartotoja
    {
        $admins = (new File('admins'))->showAll(); // pasiemam visus userius

        // var_dump($users);

        foreach ($admins as $admin) {

            // var_dump($acc);

            if ($admins['email'] == $email && $admins['password'] == md5($password)) { //tikrinam ar email ir psw atitinka
                $_SESSION['logged_in'] = true; //ant sesijos uzdedam logged_in
                $_SESSION['admin'] = $admins; //i sesija irasom userio name
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

    public static function admin()
    {
        if (isset($_SESSION['admin'])) {
            return $_SESSION['admin'];
        }
        return null;
    }

    public static function logout()
    {
        $_SESSION['logged_in'] = false;
        unset($_SESSION['admin']);
    }
}
