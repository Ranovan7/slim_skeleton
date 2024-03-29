<?php
// DIC configuration

use Slim\Views\Twig;
use Slim\Views\TwigExtension;

$container = $app->getContainer();

// view renderer
$container['view'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
	$view = new \Slim\Views\Twig($settings['template_path'], [
        // 'cache' => $settings['cache_path']
    ]);

    // Instantiate and add Slim specific extension
    $router = $c->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));
    // $view->addExtension(new \Knlv\Slim\Views\TwigMessages(new Slim\Flash\Messages()));

    return $view;
};

// not found handler
$container['notFoundHandler'] = function($c) {
    return function ($req, $rsp) use ($c) {
        return $c->view->render($rsp->withStatus(404), 'errors/404.html');
    };
};

// error handler
// if (!$container->get('settings')['debugMode'])
// {
    // $container['errorHandler'] = function($c) {
        // return function ($req, $rsp) use ($c) {
            // return $c->view->render($rsp->withStatus(500), '500.phtml');
        // };
    // };
    // $container['phpErrorHandler'] = function ($c) {
        // return $c['errorHandler'];
    // };
// }

// flash messages
// $container['flash'] = function() {
//     return new \Slim\Flash\Messages();
// };

// monolog
// $container['logger'] = function ($c) {
//     $settings = $c->get('settings')['logger'];
//     $logger = new Monolog\Logger($settings['name']);
//     $logger->pushProcessor(new Monolog\Processor\UidProcessor());
//     $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
//     return $logger;
// };

// db
$container['db'] = function($c) {
    $settings = $c->get('settings')['db'];
	$connection = $settings['connection'];
	$host = $settings['host'];
	$port = $settings['port'];
	$database = $settings['database'];
	$username = $settings['username'];
	$password = $settings['password'];

	$dsn = "$connection:host=$host;port=$port;dbname=$database";
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];

	try {
		return new PDO($dsn, $username, $password, $options);
	} catch (PDOException $e) {
		throw new PDOException($e->getMessage(), (int)$e->getCode());
	}
};

// active user
$container['user'] = function($c) {
    $session = \App\Session::getInstance();
	$user_id = $session->user_id;
	if (empty($user_id)) {
		return null;
	}

	$stmt = $c->db->prepare("SELECT * FROM users WHERE id=:id AND is_active=true");
	$stmt->execute([':id' => $user_id]);
	$user = $stmt->fetch();
	return $user ?: null;
};

?>
