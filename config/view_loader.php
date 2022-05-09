<?php
Mustache_Autoloader::register();

$loader_options = array(
    'extension' => '.html'
);

$mustache = new Mustache_Engine(array(
    //'template_class_prefix' => '.html',
    'cache' => APP_PATH.'/cache',
    //'cache_file_mode' => 0666,
    'cache_lambda_templates' => true,
    'loader' => new Mustache_Loader_FilesystemLoader(VIEWS_PATH, $loader_options),
    'partial_loaders' => new Mustache_Loader_FilesystemLoader(VIEWS_PATH, $loader_options),
    //'helpers' => array('i18n' => function() {}),
    'escape' => function($value) {
        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
    },
    'charset' => 'ISO-8859-1',
    'logger' => new Mustache_Logger_StreamLogger('php://stderr'),
    'strict_callables' => true,
    'pragmas' => [Mustache_Engine::PRAGMA_FILTERS],
));
/*echo "<pre>";
var_dump($mustache);
echo "</pre>";*/

function View($view, $arguments = []) {
    $tlp = $GLOBALS['mustache']->loadTemplate('foo');
    echo $tlp->render($arguments);
}