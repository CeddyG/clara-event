<?php

/**
 * Default config values
 */
return [
    
    'route' => [
        'web' => [
            'prefix'    => 'admin',
            'middleware' => ['web', \CeddyG\ClaraSentinel\Http\Middleware\SentinelAccessMiddleware::class]
        ],
        'api' => [
            'prefix'    => 'api/admin',
            'middleware' => ['api', \CeddyG\ClaraSentinel\Http\Middleware\SentinelAccessMiddleware::class.':api']
        ]
    ],
    
    'controller' => 'CeddyG\ClaraEvent\Http\Controllers\Admin\EventCategoryController',
    
];
