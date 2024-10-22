<?php

declare(strict_types=1);

use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use Laminas\Diactoros\Response\HtmlResponse;
use App\Views\ErrorsView;

$error = new ErrorsView();

$router = Router::create();

$router->get('/', [\App\Controllers\FrontController::class, 'index']);
$router->get('/blog/', [\App\Controllers\FrontController::class, 'showArticlesListPage']);
$router->get('/blog/{id}', [\App\Controllers\FrontController::class, 'showSingleArticlePage']);




try {
    $router->dispatch();
} catch (RouteNotFoundException $e) {
    // It's 404!
    $router->getPublisher()->publish( new HtmlResponse( $error->render404Page(), 404));
} catch (Throwable $e) {
    // Log and report...
    $router->getPublisher()->publish( new HtmlResponse( $error->render500Page(), 500));
}