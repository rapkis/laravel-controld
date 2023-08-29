<?php

// config for Rapkis/Controld
use Rapkis\Controld\Middleware\ControlDErrorHandlerMiddleware;

return [
    'url' => env('CONTROL_D_API_URL'),
    'secret' => env('CONTROL_D_API_SECRET'),
    'middleware' => [
        'request' => [],
        'response' => [ControlDErrorHandlerMiddleware::class],
    ],
];
