<?php

namespace App\Core;

class Helper
{
public static function dd($some)
{
    echo '<pre>';
    print_r($some);
    echo '</pre>';
    exit();
}
public static function goUrl(string $url)
{
    echo '<script type="text/javascript">location="';
    echo $url;
    echo '";</script>';
}
}