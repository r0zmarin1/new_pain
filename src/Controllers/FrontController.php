<?php

namespace App\Controllers;

use App\Core\CoreController;
use App\Core\Helper;
use App\Models\Article;
use App\Models\JsonModel;
use App\Views\FrontView;
use Laminas\Diactoros\ServerRequest;

class FrontController
{
    protected $View;
    private  $Model;

    public function __construct()
    {
        $this->View = new FrontView();
        $this->Model = new Article();
        //$this->Model = new JsonModel();
        //$this->Model = new MarkDownModel();
    }
    public function index()
    {
        $this->View->showIndexPage();
    }

    public function showArticlesListPage()
    {
        $articles = $this->Model->getAll();
        $this->View->renderArticlesListPage($articles);
    }
    public function showSingleArticlePage($id)
    {
        $article = $this->Model->find($id);
        $this->View->renderSingleArticlePage($article);
    }

    public function showAuthorizationPage()
    {
        $this->View->renderAuthorizationPage();
    }

    public function authorizationEntry(ServerRequest $request)
    {
        $login = $request->getParsedBody();
        //var_dump($login);
//
//        else
//        {
            define('ADMIN' , 'admin' );
            if(!empty( $_POST['login']))
            {
                if( $_POST['login'] === ADMIN )
                {
                    $_SESSION[ 'admin' ] = ADMIN ;
                    echo 'Вы успешно авторизовались!';
                    Helper::goUrl('/admin/articles');
                }
                else
                {
                    echo 'Неверный логин' ;
                }
            }


    }
}