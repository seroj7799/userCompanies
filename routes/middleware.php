<?php
return [
    'web' => [
        // Other web middleware...
    ],

    'api' => [
        // Other API middleware...
    ],

    'admin.auth' => App\Http\Middleware\AdminAuthMiddleware::class, // Add this line
];
