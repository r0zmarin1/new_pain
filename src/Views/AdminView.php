<?php

namespace App\Views;

use App\Core\CoreView;

class AdminView extends CoreView
{
    public function __construct()
    {
        $this->setLoader('template/admin/');
        $this->twig = new \Twig\Environment($this->loader, []);
    }

    public function renderIndexPage()
    {
        return $this->twig->render('layout.twig',[]);
    }

    public function showArticlesTable(array $articles)
    {
        return $this->twig->render('/articles/index-table.twig',[]);
    }

}