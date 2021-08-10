<?php

use Phroute\Phroute\Dispatcher;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;

require_once "vendor/autoload.php";
// require_once "view/home.php";

$router = new RouteCollector();

require_once "routes.php";

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Dispatcher( $router->getData() );
try {
    $response = $dispatcher->dispatch( $_SERVER['REQUEST_METHOD'], parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );
} catch ( HttpMethodNotAllowedException $e ) {
    echo $e->getMessage();
    die();
}

// Print out the value returned from the dispatched function
echo $response;