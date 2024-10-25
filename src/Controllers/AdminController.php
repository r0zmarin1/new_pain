<?php

namespace App\Controllers;

use App\Models\Article;
use App\Views\AdminView;

class AdminController
{
    protected $View;
    private  $Article;

    public function __construct()
    {
        $this->View = new AdminView();
        $this->Article = new Article();
    }

    public function index()
    {

        echo $this->View->renderIndexPage();
    }

    public function showArticlesTable()
    {
        $articles = $this->Article->getAll();
        echo $this->View->showArticlesTable($articles);
    }

}