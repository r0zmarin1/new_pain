<?php

namespace App\Core;

use App\Core\Interfaces\ViewInterface;

class CoreView implements ViewInterface
{
    protected $loader;
    protected $twig;

    public function __construct()
    {
        $this->setLoader('template/');
        $this->twig = new \Twig\Environment($this->loader, []);

        $this->twig->addGlobal('session', $_SESSION);
    }

    public function setLoader($path)
    {
        $this->loader = new \Twig\Loader\FilesystemLoader($path);
    }

    public function renderIndexPage()
    {
        $pagetitle = "Admin Panel";
        return $this->twig->render('admin/layout.twig',compact('pagetitle'));
    }

    public function showArticlesTable(array $articles)
    {
        $pagetitle = "Список статей";
        return $this->twig->render('admin/articles/index-table.twig',compact('articles','pagetitle'));
    }

    public function showArticleAddPage()
    {
        $pagetitle = "Добавление статьи";
        return $this->twig->render('admin/articles/add-form.twig',compact('pagetitle'));
    }
    public function showArticleEditPage($article)
    {
        $pagetitle = "Редактирование статьи";
        return $this->twig->render('admin/articles/edit-form.twig',compact('pagetitle', 'article'));
    }

}