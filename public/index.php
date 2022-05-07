<?php
require_once dirname(__DIR__).'/vendor/autoload.php';

error_reporting(-1);
ini_set('display_errors', 'On');

define('APP_PATH', dirname(__DIR__).'/app');
define('ROUTES_PATH', dirname(__DIR__).'/routes');
define('DEBUG', true);

require_once APP_PATH.'/config/routing/router.php';
echo $response;