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
                    .'|(\\d+)(*:24)'
                    .'|([^/]++)/([^/]++)(*:48)'
                .')'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        24 => [[['_route' => 'example2', '_controller' => 'Foo::params'], ['id'], null, null, false, true, null]],
        48 => [
            [['_route' => 'example3', '_controller' => 'Foo::params'], ['id', 'string'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
