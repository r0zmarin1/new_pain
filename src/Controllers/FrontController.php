<?php

namespace App\Controllers;

use App\Core\CoreController;
use App\Models\JsonModel;
use App\Views\FrontView;

class FrontController
{
    protected $View;
    private  $Model;

    public function __construct()
    {
        $this->View = new FrontView();
        $this->Model = new JsonModel();
        //$this->Model = new MarkDownModel();
    }
    public function index()
    {
        $this->View->showIndexPage();
    }
    public function showArticlesListPage()
    {
        $articles = $this->Model->getArticles();
        $this->View->renderArticlesListPage($articles);
    }
    public function showSingleArticlePage($id)
    {
        $article = $this->Model->getArticleById($id);
        $this->View->renderSingleArticlePage($article);
    }
}