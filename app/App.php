<?php

namespace Bank;

use Bank\Controllers\BankController as BANK;

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

        if ($method == 'GET' && count($uri) == 1 && $uri[0] == 'bank') {
            return (new BANK)->index();
        }
        if ($method == 'GET' && count($uri) == 2 && $uri[0] == 'bank' && $uri[1] == 'create') {
            return (new BANK)->create();
        }





        return 'Page not found!';
    }

    public static function view($path, $data = null)
    {
        if ($data) {
            extract($data);
        }

        ob_start();

        require ROOT . 'resources/view/layout/top.php';

        require ROOT . 'resources/view/' . $path . '.php';

        require ROOT . 'resources/view/layout/bottom.php';

        return ob_get_clean();
    }
}
