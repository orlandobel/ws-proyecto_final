<?php
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Generator\urlGenerator;
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
    $parameters = get_parameters($attributes);
    
    /*print_r('<pre>');
    var_dump($attributes);
    var_dump($parameters);
    print_r('</pre>');*/
    
    $classname = $attributes['_controller'];

    list($classname, $method) = explode("::", $classname);
    $class = "App\\Controllers\\$classname";

    $controller = new $class();
    //$response = $controller->$method();
    print_r($controller->$method(...$parameters)."</br>");
    
    $response = 'Building';
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
} catch(Throwable $throwable) {
    $response = new Response("Internal Server Exception", Response::HTTP_INTERNAL_SERVER_ERROR);
}

function get_parameters($attributes) {
    $parameters = array_filter($attributes, function($attribute) {
        return !str_starts_with($attribute, "_");
    }, ARRAY_FILTER_USE_KEY);

    return $parameters;
}

//return $response;