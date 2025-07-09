<?php

return [
    'host' => env('RABBIT_MQ_HOST', '127.0.0.1'),
    'port' => env('RABBIT_MQ_PORT', 5672),
    'user' => env('RABBIT_MQ_USER', 'guest'),
    'password' => env('RABBIT_MQ_PASSWORD', 'guest'),
];
