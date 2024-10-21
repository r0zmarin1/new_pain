<?php

namespace App\Models;

class JsonModel
{
    protected $storage_path;

    public function __construct()
    {
        $this->setStoragePath('db/articles.json');
    }

    public function setStoragePath($path)
    {
        $this->storage_path = $path;
    }

    public function getArticles(): array
    {
        return json_decode(file_get_contents($this->storage_path), true);
    }

    public function getArticleById(int $id): array
    {
        $articleList = $this->getArticles();
        $curentArticle = [];
        if (array_key_exists($id, $articleList)) {
            $curentArticle = $articleList[$id];
        }
        return $curentArticle;
    }

}