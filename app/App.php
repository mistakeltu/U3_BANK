<?php

namespace Bank;

use Bank\Controllers\BankController as BANK;
use Bank\Controllers\LoginController as LOGIN;
use Bank\Controllers\HomeController as HOME;
use Bank\Auth;
use Bank\Messages;

class App
{

    public static function start()
    {
        return self::router();
    }

    public static function router()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);
        array_shift($uri);
        $method = $_SERVER['REQUEST_METHOD'];

        //home page

        if ($method == 'GET' && count($uri) == 1 && $uri[0] == '') {
            return (new HOME)->index();
        }

        //Login, logout, register

        if ($method == 'GET' && count($uri) == 1 && $uri[0] == 'login') {
            return (new LOGIN)->showLogin();
        }
        if ($method == 'POST' && count($uri) == 1 && $uri[0] == 'login') {
            return (new LOGIN)->login();
        }
        if ($method == 'POST' && count($uri) == 1 && $uri[0] == 'logout') {
            return (new LOGIN)->logout();
        }
        if ($method == 'GET' && count($uri) == 1 && $uri[0] == 'register') {
            return (new LOGIN)->showRegister();
        }
        if ($method == 'POST' && count($uri) == 1 && $uri[0] == 'register') {
            return (new LOGIN)->register();
        }

        //tikrinimas ar useris yra prisilogines
        if ($uri[0] == 'bank' && !Auth::check()) {
            return self::redirect('login');
        }

        //Routes

        if ($method == 'GET' && count($uri) == 1 && $uri[0] == 'bank') {
            return (new BANK)->index();
        }
        if ($method == 'GET' && count($uri) == 2 && $uri[0] == 'bank' && $uri[1] == 'create') {
            return (new BANK)->create();
        }
        if ($method == 'POST' && count($uri) == 2 && $uri[0] == 'bank' && $uri[1] == 'store') {
            return (new BANK)->store();
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'delete') {
            return (new BANK)->delete($uri[2]);
        }
        if ($method == 'POST' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'destroy') {
            return (new BANK)->destroy($uri[2]);
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'edit') {
            return (new BANK)->edit($uri[2]);
        }
        if ($method == 'POST' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'update') {
            return (new BANK)->update($uri[2]);
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'show') {
            return (new BANK)->show($uri[2]);
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'addCard') {
            return (new BANK)->addCard($uri[2]);
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'minusCard') {
            return (new BANK)->minusCard($uri[2]);
        }
        if ($method == 'POST' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'addToAcc') {
            return (new BANK)->addToAcc($uri[2]);
        }
        if ($method == 'POST' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'minusFromAcc') {
            return (new BANK)->minusFromAcc($uri[2]);
        }



        return 'Page not found!';
    }

    public static function view($path, $data = null)
    {
        if ($data) {
            extract($data);
        }

        $admin = Auth::admin();

        $messages = Messages::get();

        ob_start();

        require ROOT . 'resources/view/layout/top.php';

        require ROOT . 'resources/view/' . $path . '.php';

        require ROOT . 'resources/view/layout/bottom.php';

        clearFlash();

        return ob_get_clean();
    }

    public static function redirect($url)
    {
        header('Location:' . URL . $url);
        return;
    }
}
