<?php
require_once __DIR__.'/../vendor/autoload.php';

use Laminas\Diactoros\ServerRequestFactory;

error_reporting(-1);
ini_set('display_errors', 'On');

define('APP_PATH', dirname(__DIR__).'/app');
define('DEBUG', true);

$response = require APP_PATH.'/config/routing/router.php';

echo $response;
/*require_once APP_PATH.'config/routing/matcher.php';
require_once dirname(__DIR__).'/routes/app.php';

$reflection = new ReflectionClass($map);
$prop = $reflection->getProperty('routes');
$prop->setAccessible(true);

var_dump( $prop->getValue($map));*/

/*$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);*/

