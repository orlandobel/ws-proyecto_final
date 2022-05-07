<?php
require_once dirname(__DIR__).'/vendor/autoload.php';

error_reporting(-1);
ini_set('display_errors', 'On');

define('APP_PATH', dirname(__DIR__).'/app');
define('ROUTES_PATH', dirname(__DIR__).'/routes');
define('VIEWS_PATH', dirname(__DIR__).'/src/views');
define('DEBUG', true);

require_once APP_PATH.'/config/view_loader.php';
require_once APP_PATH.'/config/router.php';

//View('foo', ['test' => 'testing rendering of arguments']);

//echo $response;