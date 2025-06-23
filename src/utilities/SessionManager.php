<?php

namespace Irfan\Phplearning\utilities;

class SessionManager implements SessionManagerContract
{

    public function startSession():void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function saveValue(string $key,string $value):void
    {
        $_SESSION[$key] = $value;
    }
    public function getValue(string $key):string
    {
        return $_SESSION[$key]??'';
    }

    public function clear()
    {

    }

}