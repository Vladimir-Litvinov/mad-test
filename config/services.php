<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '350263046154506',
        'client_secret' => 'fd07484b94bdfe009d22b4b310b56acb',
        'redirect' => 'http://localhost:8000/api/login/facebook/callback',
    ],

    'google' => [
        'client_id' => '322613467249-2aa8v7iihrnqq78s4kouf540jdvruuq1.apps.googleusercontent.com',
        'client_secret' => 'fd07484b94bdfe009d22b4b310b56acb',
        'redirect' => 'http://localhost:8000/api/login/google/callback',
    ],

];
