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

    'google' => [
        'client_id' => '47640296392-notjhbtgq0oqvia894v82kvckal1ttjf.apps.googleusercontent.com',
        'client_secret' => 'YAxUfagErE6BndFMK4Zk10ZH',
        'redirect' => 'https://gmagnet.herokuapp.com/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '190576839455379',
        'client_secret' => 'a1fa86fb769c962b5dce0aaaabbca239',
        'redirect' => 'https://gmagnet.herokuapp.com/auth/facebook/callback',
    ],

];
