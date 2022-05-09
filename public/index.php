<?php
require_once dirname(__DIR__).'/vendor/autoload.php';

error_reporting(-1);
ini_set('display_errors', 'On');

require_once dirname(__DIR__).'/config/definitions.php';
require_once CONFIG_PATH.'/global_functions.php';
require_once CONFIG_PATH.'/router.php';

if($response instanceof Symfony\Component\HttpFoundation\Response) {
    echo $response->getContent();
} else {
    echo $response;
}