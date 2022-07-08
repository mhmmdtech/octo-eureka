<?php

return [
    'APP_TITLE' => 'Legend',
    'DEVELOPER_TEAM' => 'NULLA',
    'BASE_URL' => 'http://localhost:8000',
    'BASE_DIR' => dirname(__DIR__),

    //providers
    'providers' => [
        \App\Providers\SessionProvider::class,
        \App\Providers\AppServiceProvider::class,
    ]
];
