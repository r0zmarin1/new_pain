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
}