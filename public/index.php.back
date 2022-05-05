<?php
require_once __DIR__.'/../vendor/autoload.php';

use Aura\Router\RouterContainer;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\Response;


error_reporting(-1);
ini_set('display_errors', 'On');

$routerConrainer = new RouterContainer();

$map = $routerConrainer->getMap();
$map->get('home', '/', function() { return 'hello';});

$matcher = $routerConrainer->getMatcher();

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$route = $matcher->match($request);

if(!$route) {
    echo "route not found";
    exit;
}

foreach($route->attributes as $key => $val) { 
    $request = $request->withAttribute($key, $val);
}

$callable = $route->handler;

$response = new Response();
$message = $callable($request, $response);

if(!is_string($message)){
    foreach($message->getHeaders() as $name => $values) {
        foreach($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }
} else {
    echo $message;
}