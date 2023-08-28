<?php

namespace Bank\DB;

use Bank\DB\File;
use Bank\DB\MariaDB;


class Storage
{

    // private static $type = 'MariaDB';
    private static $type = 'File';

    public static function getStorage($from)
    {

        return match (self::$type) {
            'File' => new File($from),
            'MariaDB' => new MariaDB($from),
            default => throw new \Exception('Undefined storage type'),
        };
    }
}
