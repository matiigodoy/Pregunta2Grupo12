<?php

class SessionManager
{
    public function __construct()
    {
        $this->startSession();
    }
    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function setUser($value)
    {
        $_SESSION['user'] = $value;
    }
    public function getUser()
    {
        return $_SESSION['user'];
    }
    public function destroy()
    {
        session_unset();
        session_destroy();
    }
}