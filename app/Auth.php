<?php

namespace Bank;

use Bank\DB\File;
use Bank\DB\Storage;

class Auth
{
    public static function attempt($email, $password): bool //f-ja kuri bando prijungti vartotoja
    {
        $admins = Storage::getStorage('user')->showAll(); // pasiemam visus userius

        // var_dump($users);

        foreach ($admins as $admin) {

            // var_dump($acc);

            if ($admin['email'] == $email && $admin['password'] == md5($password)) { //tikrinam ar email ir psw atitinka
                $_SESSION['logged_in'] = true; //ant sesijos uzdedam logged_in
                $_SESSION['admin'] = $admin; //i sesija irasom userio name
                return true;
            }
        }
        return false;
    }

    public static function check(array $roles, bool $header = false)
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && in_array($_SESSION['admin']['role'], $roles)) {
            return true;
        }
        if ($header) {
            http_response_code(403);
        } else {
            return false;
        }
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

    public static function register($name, $email, $password) //$personalCode
    {
        $user = [
            'name' => $name,
            'email' => $email,
            'password' => md5($password),
            // 'personalCode' => $personalCode,
            'role' => 'user'
        ];

        Storage::getStorage('user')->create($user);
    }
}
