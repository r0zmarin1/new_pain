<?php

namespace App\Views;

use App\Core\CoreView;
use App\Core\Helper;

class AdminView extends CoreView
{
    public function __construct()
    {
        $this->setLoader('template/admin/');
        $this->twig = new \Twig\Environment($this->loader, []);
    }

    public function renderIndexPage()
    {
        $pagetitle = "Admin Panel";
        return $this->twig->render('layout.twig',compact('pagetitle'));
    }

    public function showArticlesTable(array $articles)
    {
        $pagetitle = "Список статей";
        return $this->twig->render('/articles/index-table.twig',compact('articles','pagetitle'));
    }

    public function showArticleAddPage()
    {
        $pagetitle = "Добавление статьи";
        return $this->twig->render('/articles/add-form.twig',compact('pagetitle'));
    }
    public function showArticleEditPage($article)
    {
        $pagetitle = "Редактирование статьи";
        return $this->twig->render('/articles/edit-form.twig',compact('pagetitle', 'article'));
    }
    public function showArticleDeletePage($article)
    {
        $pagetitle = "Удаление статьи";
        return $this->twig->render('/articles/delete.twig',compact('pagetitle', 'article'));
    }



}