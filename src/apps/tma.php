<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/tma', function() {

    $this->get('', function ($request, $response, $args) {
        return $this->view->render($response, 'tma/index.html');
    });

    $this->get('/jamjaman', function ($request, $response, $args) {
        return $this->view->render($response, 'tma/index.html');
    });

    $this->get('/harian', function ($request, $response, $args) {
        return $this->view->render($response, 'tma/index.html');
    });

    $this->get('/bulanan', function ($request, $response, $args) {
        return $this->view->render($response, 'tma/index.html');
    });

    $this->get('/tahunan', function ($request, $response, $args) {
        return $this->view->render($response, 'tma/index.html');
    });

})
// })->add(\App\Middlewares\AuthMiddlewares\CurahHujanMiddleware::class);

?>
