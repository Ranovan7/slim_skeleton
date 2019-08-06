<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/curahhujan', function() {
    // echo '<pre>' . var_export($container, true) . '</pre>';
    // die();

    $this->get('', function ($request, $response, $args) {
        return $this->view->render($response, 'curahhujan/index.html');
    });

    $this->get('/jamjaman', function ($request, $response, $args) {
        return $this->view->render($response, 'curahhujan/index.html');
    });

    $this->get('/harian', function ($request, $response, $args) {
        return $this->view->render($response, 'curahhujan/index.html');
    });

    $this->get('/bulanan', function ($request, $response, $args) {
        return $this->view->render($response, 'curahhujan/index.html');
    });

    $this->get('/tahunan', function ($request, $response, $args) {
        return $this->view->render($response, 'curahhujan/index.html');
    });

})
// })->add(\App\Middlewares\AuthMiddlewares\CurahHujanMiddleware::class);

?>
