<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/' => [[['_route' => 'home', '_controller' => 'Foo::foo'], null, null, null, false, false, null]],
        '/example' => [[['_route' => 'example', '_controller' => 'Foo::hey'], null, null, null, true, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/example/(?'
                    .'|([^/]++)/([^/]++)(*:36)'
                    .'|(\\d+)(*:48)'
                .')'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        36 => [[['_route' => 'example2', '_controller' => 'Foo::params'], ['id', 'string'], null, null, false, true, null]],
        48 => [
            [['_route' => 'example3', '_controller' => 'Foo::params'], ['id'], null, null, true, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
