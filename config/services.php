<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id' => getenv('GITHUB_KEY'),
        'client_secret' => getenv('GITHUB_SECRET'),
        'redirect' => getenv('BASE_URL') . '/auth/github/callback',
    ],

    'facebook' => [
        'client_id' => getenv('FACEBOOK_KEY'),
        'client_secret' => getenv('FACEBOOK_SECRET'),
        'redirect' => getenv('BASE_URL') . '/auth/facebook/callback',
    ],
    'twitter' => [
        'client_id' => getenv('TWITTER_KEY'),
        'client_secret' => getenv('TWITTER_SECRET'),
        'redirect' => getenv('BASE_URL') . '/auth/twitter/callback',
    ],
    'google' => [
        'client_id' => getenv('GOOGLE_KEY'),
        'client_secret' => getenv('GOOGLE_SECRET'),
        'redirect' => getenv('BASE_URL') . '/auth/google/callback',
    ],
];
