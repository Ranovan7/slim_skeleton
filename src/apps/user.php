<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/user', function() {

    $this->get('', function ($request, $response, $args) {
        return $this->view->render($response, 'user/index.html');
    });

    $this->get('/{id}/password', function ($request, $response, $args) {
        return $this->view->render($response, 'user/index.html');
    });

    $this->get('/{id}/del', function ($request, $response, $args) {
        return $this->view->render($response, 'user/index.html');
    });

    $this->get('/add', function ($request, $response, $args) {
        return $this->view->render($response, 'user/index.html');
    });

})
// })->add(\App\Middlewares\AuthMiddlewares\CurahHujanMiddleware::class);

?>
