<?php
require_once APP_PATH.'/config/routing/matcher.php';

$map->get('home', '/', function() { return 'hello';});