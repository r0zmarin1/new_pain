<?php

namespace App\Controllers;

use App\Models\Article;
use App\Views\AdminView;
use Laminas\Diactoros\ServerRequest;
use App\Core\Helper;


class AdminController
{
    protected $View;
    private $Article;

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

    public function showArticleAddPage()
    {
        //$articles = $this->Article->getAll();
        echo $this->View->showArticleAddPage();

    }
    public function showArticleEditPage($id)
    {
        $article = $this->Article->find($id);
        echo $this->View->showArticleEditPage($article);
    }


    public function addArticle(ServerRequest $request)
    {
        $article = $request->getParsedBody();
        if (!empty($article['title']) && !empty($article['content'])) {
            $this->Article->add($article);
            Helper::goUrl('/admin/articles');
        } else {
            Helper::goUrl('/admin/article/add');
        }
    }
    public function updateArticle(ServerRequest $request)
    {
        //var_dump($request);
        $article = $request->getParsedBody();
        $this->Article->update($article);
        Helper::goUrl('/admin/articles');

    }

    public function deleteArticle($id)
    {
        $this->Article->delete($id);
        Helper::goUrl('/admin/articles');
    }

}