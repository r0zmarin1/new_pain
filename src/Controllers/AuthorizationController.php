<?php

namespace App\Controllers;

use App\Views\AdminView;
use App\Core\Helper;

class AuthorizationController
{
    protected $View;

    public function __construct()
    {
        $this->View = new AdminView();
    }

    public function login()
    {

    }

}