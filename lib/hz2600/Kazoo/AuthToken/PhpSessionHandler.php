<?php

namespace Kazoo\AuthToken;

use \SessionHandler;

class PhpSessionHandler extends SessionHandler
{
    public function sessionStart()
    {
        @session_start();
    }


    public function put($path, $value)
    {
        $_SESSION[$path] = $value;
    }

    public function isValueSet($path)
    {
        return isset($_SESSION[$path]);
    }


    public function forget($path)
    {
        unset($_SESSION[$path]);
    }

    public function get($path)
    {
        return $_SESSION[$path];
    }

}