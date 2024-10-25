<?php

namespace App\Models;

use PDO;
use App\Core\Helper as h;

class Article
{
    protected $pdo;
    protected $table;
    public function __construct()
    {
        $host = '192.168.200.79';
        $db = '2024';
        $user = 'user';
        $pass = 'user';
        $charset = 'utf8';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            //PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
        $this->setTable('articles');
    }

    /**
     * @param mixed $table
     */
    public function setTable($table): void
    {
        $this->table = $table;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM '.$this->table );
        $stmt->execute([]);
        return $stmt->fetchAll();
    }

    public function find($id): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE id = :id');
        $stmt->execute([ 'id' => $id ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}