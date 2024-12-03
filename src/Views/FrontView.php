<?php

namespace App\Views;

use App\Core\CoreView;

class FrontView extends CoreView
{
    public function showIndexPage()
    {
        $title = 'Главная страница';
        $description = 'Страдаем';
        echo $this->twig->render('front/index.twig', ['title' => $title, 'description' => $description]);
    }

    public function renderArticlesListPage($articles)
    {
        $title = 'Блог на Json';
        $description = 'Вывод всех статей';
        echo $this->twig->render('front/articles-list.twig',compact('title', 'description', 'articles'));
    }
    public function renderSingleArticlePage($article)
    {
        $title = 'Блог на Json';
        $description = 'Вывод стастьи';
        echo $this->twig->render('front/single-article-page.twig',compact('title', 'description', 'article'));
    }

    public function renderAuthorizationPage()
    {
        $title = 'Авторизация';
        $description = 'Страдаем';
        echo $this->twig->render('front/authorization.twig', compact('title', 'description'));
    }
}