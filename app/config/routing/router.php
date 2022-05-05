<?php

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\Diactoros\Response;

require_once APP_PATH.'/config/routing/matcher.php';
require_once APP_PATH.'/../routes/app.php';

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$route = $matcher->match($request);

if(!$route) {
    return "Route not Found";
}

foreach($route->attributes as $key => $val) {
    $request = $request->withAttribute($key, $val);
}

$callable = $route->handler;

$response = new Response();
$message = $callable($request, $response);

if(!is_string($message)) {
    foreach($message->getHeaders() as $name => $values) {
        foreach($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }
}

return $message;