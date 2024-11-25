<?php

namespace App\Traits;

trait Auth
{
    public function check()
    {
        if($_SESSION['user'] != null)
            return true;
        else
            return false;
    }
    public function login($login)
    {
        if($login != null)
        {
            //set($_SESSION['user']->login, $login);
            $_SESSION['user'] = $login;
        }
    }
    public function logout()
    {
        if($_SESSION['user'] == null)
        {
            echo 'Вы не в сессии';
        }
        else
            unset($_SESSION['user']);
    }
}