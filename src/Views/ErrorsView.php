<?php

namespace App\Views;

use App\Core\CoreView;

class ErrorsView extends CoreView
{
    public function __construct()
    {
        $this->setLoader('template/errors/');
        $this->twig = new \Twig\Environment($this->loader, []);
    }
    public function render404Page()
    {
        return $this->twig->render('error-404.twig',[]);
    }
    public function render500Page()
    {
        echo $this->twig->render('error-500.twig',[]);
    }

}