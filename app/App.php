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
            return !Auth::check(['admin', 'user'], true) ? (new LOGIN)->showLogin() : self::redirect('');
        }
        if ($method == 'POST' && count($uri) == 1 && $uri[0] == 'login') {
            return !Auth::check(['admin', 'user'], true) ? (new LOGIN)->login() : self::redirect('');
        }
        if ($method == 'POST' && count($uri) == 1 && $uri[0] == 'logout') {
            return Auth::check(['admin', 'user'], true) ? (new LOGIN)->logout() : self::redirect('');
        }
        if ($method == 'GET' && count($uri) == 1 && $uri[0] == 'register') {
            return !Auth::check(['admin', 'user'], true) ? (new LOGIN)->showRegister() : self::redirect('');
        }
        if ($method == 'POST' && count($uri) == 1 && $uri[0] == 'register') {
            return !Auth::check(['admin', 'user'], true) ? (new LOGIN)->register() : self::redirect('');
        }

        //tikrinimas ar useris yra prisilogines
        // if ($uri[0] == 'bank' && !Auth::check()) {
        //     return self::redirect('login');
        // }

        //Routes

        if ($method == 'GET' && count($uri) == 1 && $uri[0] == 'bank') {
            return Auth::check(['admin', 'user'], true) ? (new BANK)->index() : self::viewError('403');
        }
        if ($method == 'GET' && count($uri) == 2 && $uri[0] == 'bank' && $uri[1] == 'create') {
            return Auth::check(['admin'], true) ? (new BANK)->create() : self::viewError('403');
        }
        if ($method == 'POST' && count($uri) == 2 && $uri[0] == 'bank' && $uri[1] == 'store') {
            return Auth::check(['admin'], true) ? (new BANK)->store() : self::viewError('403');
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'delete') {
            return Auth::check(['admin'], true) ? (new BANK)->delete($uri[2]) : self::viewError('403');
        }
        if ($method == 'POST' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'destroy') {
            return Auth::check(['admin'], true) ? (new BANK)->destroy($uri[2]) : self::viewError('403');
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'edit') {
            return Auth::check(['admin'], true) ? (new BANK)->edit($uri[2]) : self::viewError('403');
        }
        if ($method == 'POST' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'update') {
            return Auth::check(['admin'], true) ? (new BANK)->update($uri[2]) : self::viewError('403');
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'show') {
            return Auth::check(['admin', 'user'], true) ? (new BANK)->show($uri[2]) : self::viewError('403');
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'addCard') {
            return Auth::check(['admin'], true) ? (new BANK)->addCard($uri[2]) : self::viewError('403');
        }
        if ($method == 'GET' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'minusCard') {
            return Auth::check(['admin'], true) ? (new BANK)->minusCard($uri[2]) : self::viewError('403');
        }
        if ($method == 'POST' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'addToAcc') {
            return Auth::check(['admin'], true) ? (new BANK)->addToAcc($uri[2]) : self::viewError('403');
        }
        if ($method == 'POST' && count($uri) == 3 && $uri[0] == 'bank' && $uri[1] == 'minusFromAcc') {
            return Auth::check(['admin'], true) ? (new BANK)->minusFromAcc($uri[2]) : self::viewError('403');
        }


        http_response_code(404);
        return self::viewError('404');
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

    public static function viewError($path)
    {

        ob_start();

        require ROOT . 'resources/view/errors/' . $path . '.php';

        clearFlash();

        return ob_get_clean();
    }

    public static function redirect($url)
    {
        header('Location:' . URL . $url);
        return;
    }
}
