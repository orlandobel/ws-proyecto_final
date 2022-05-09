<?php
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$locator = new FileLocator(array(ROUTES_PATH));
$loader = new YamlFileLoader($locator);

$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());

try {
    $router = new Router(
        $loader,
        'index.yml',
        array('cache_dir' => APP_PATH.'/cache'),
        $context
    );

    $routes = $router->getRouteCollection();
    $attributes = $router->match($context->getPathInfo());
    
    $classname = $attributes['_controller'];
    
    $parameters = get_parameters($attributes);
    $parameters['request'] = Request::createFromGlobals();
    
    list($classname, $method) = explode("::", $classname);
    $class = "App\\Controllers\\$classname";
    
    $controller = new $class();
    $controller->initTwig();
    
    $response = $controller->$method(...$parameters);
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
} catch(Throwable $throwable) {
    $response = new Response("Internal Server Exception", Response::HTTP_INTERNAL_SERVER_ERROR);
}

function get_parameters($attributes): array {
    $parameters = array_filter($attributes, function($attribute) {
        return !str_starts_with($attribute, "_");
    }, ARRAY_FILTER_USE_KEY);

    return $parameters;
}