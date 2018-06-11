<?php

return [
    'credentials' => [
        'key'    => env('YOUR_AWS_ACCESS_KEY_ID'),
        'secret' => env('YOUR_AWS_SECRET_ACCESS_KEY'),
    ],
    'region' => env('YOUR_AWS_REGION', 'us-east-1'),
    'version' => 'latest'
];
