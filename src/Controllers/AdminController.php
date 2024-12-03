<?php

namespace App\Controllers;

use App\Core\CoreController;
use App\Models\Article;
use App\Views\AdminView;
use Laminas\Diactoros\ServerRequest;
use App\Core\Helper;
use App\Core\Interfaces\ControllerInterface;


class AdminController extends CoreController implements ControllerInterface
{
//    protected $View;
//    private $Article;
//
//    public function __construct()
//    {
//        $this->View = new AdminView();
//        $this->Article = new Article();
//    }

//    public function index(ServerRequest $request)
//    {
//        echo $this->View->renderIndexPage();
//    }

//    public function showArticlesTable()
//    {
//        $articles = $this->Article->getAll();
//        echo $this->View->showArticlesTable($articles);
//    }

//    public function showArticleAddPage()
//    {
//        //$articles = $this->Article->getAll();
//        echo $this->View->showArticleAddPage();
//
//    }
//    public function showArticleEditPage($id)
//    {
//        $article = $this->Article->find($id);
//        echo $this->View->showArticleEditPage($article);
//    }

  public function exitAuthorization()
    {
        if(isset($_SESSION ['admin'])){
            unset($_SESSION ['admin']);
            echo 'Вы успешно вышли из сессии';
        }
        else
            echo 'Вы не в сессии';
        Helper::goUrl('/blog');
    }

//    public function addArticle(ServerRequest $request)
//    {
//        $article = $request->getParsedBody();
//        $filtered = \GUMP::filter_input($article, $this->Article->filter);
//        unset($filtered['id']);
//        $is_valid=\GUMP::is_valid($filtered, $this->Article->rules);
//        if ($is_valid === true)
//        {
//            if($this->Article->add($filtered) == null)
//            {
//                echo "Статья добавлена";
//                Helper::goUrl('/admin/articles');
//            }
//        }
//        else
//        {
//            echo $is_valid;
//            Helper::goUrl('/admin/article/add');
//        }
        //$this->setmessage($message);
//        if (!empty($article['title']) && !empty($article['content'])) {
//            $this->Article->add($article);
        //Helper::goUrl('/admin/articles');
//
//        } else {
//            Helper::goUrl('/admin/article/add');v
//        }
    //}
//    public function updateArticle(ServerRequest $request)
//    {
//        //var_dump($request);
//        $article = $request->getParsedBody();
//        $this->Article->update($article);
//        Helper::goUrl('/admin/articles');
//
//    }

//    public function deleteArticle($id)
//    {
//        $this->Article->delete($id);
//        Helper::goUrl('/admin/articles');
//    }

}