<?php
// --------- display all errors
use App\Core\Helper as h;
use App\Models\Article;

error_reporting(E_ALL);
ini_set('display_errors', 'on');
// --------------

session_start();



require __DIR__.'/vendor/autoload.php';
//$whoops = new \Whoops\Run;
//$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//$whoops->register();
require __DIR__.'/src/bootstrap.php';

