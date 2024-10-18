
# Урок №1

## Дано:

- список статей хранится в /db/articles.json  
- в файле index.php включен вывод ошибок и файл /inc/function.php содержащий следующие функции:

``` php
/**  
* функция возвращает масив статей * @return array  
*/  
function getArticles(): array  
{  
    return json_decode(file_get_contents('db/articles.json'), true);  
}

/**  
 * функция возвращает статью  в виде масива по id * @param int $id  
  * @return array  
  */  
function getArticleById(int $id): array  
{  
    $articleList = getArticles();  
    $curentArticle = [];  
    if (array_key_exists($id, $articleList)) {  
          $curentArticle = $articleList[$id];  
    }
    return $curentArticle;  
}

/**  
 * @param $some  
 * отладочная функция  
 */
 function dd($some)  
{  
    echo '<pre>';  
    print_r($some);  
    echo '</pre>';  
    exit();  
}  
  
/**  
 * @param $url  
 * редирект на указаный URL  
 */
 function goUrl(string $url)  
{  
    echo '<script type="text/javascript">location="';  
    echo $url;  
    echo '";</script>';  
}
```
## Задание :

* Сверстать главную страницу на которой выводится список всех статей в виде карточек
* Сверстать страницу на которой выводится одна стать в виде карточки
* Верстка страниц на [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
* Реализовать навигацию по сайту с использованием PHP и глобального массива $_GET[]


[<- Вернутся к содержанию](/doc/index.md)

