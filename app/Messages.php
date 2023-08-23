<?php

namespace Bank;


class Messages
{
    //koks tekstas yra
    public static function add($text, $type = 'info')
    {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = [];
        }
        $_SESSION['messages'][] = [
            'text' => $text,
            'type' => $type,
        ];
    }
    //kai gettinam tada messages istrinam
    public static function get()
    {
        if (isset($_SESSION['messages'])) {
            $messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
            return $messages;
        }
        return [];
    }
}
