<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpKernel;

error_reporting(-1);
ini_set('display_errors', 'On');

define('APP_PATH', dirname(__DIR__).'/app');
define('DEBUG', true);

$locator = new FileLocator(array(dirname(__DIR__).'/routes'));
$loader = new YamlFileLoader($locator);
$routes = $loader->load('routes.yml');
//var_dump($routes->all()['home']);

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

//var_dump($context->getPathInfo());

//$routes = new RouteCollection();
//$routes->add('', new Route('/', ['handler' => function(Request $request) { return new Response('hola', 200); }]));

try {
    $matcher = new UrlMatcher($routes, $context);
    $route = $matcher->match($context->getPathInfo());

    //var_dump($route);

    $callable = $route['handler'];
    $response = $callable($request);

} catch(ResourceNotFoundException $e) {
    echo $e->getMessage().'</br>';
    $response = new Response('Not Found', 404);
} catch(Throwable $throwable) {
    $response = new Response("Internal Server Exception", 500);
}

http_response_code($response->getStatusCode());
echo $response->getContent();

function accessProtected($obj, $prop) {
    $reflection = new ReflectionClass($obj);
    $property = $reflection->getProperty($prop);
    $property->setAccessible(true);
    return $property->getValue($obj);
}