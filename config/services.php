<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
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

    'google' => [
		'client_id' => '616515585823-9eh5bhtla6kp7fcvr90rok3lnmrjtadv.apps.googleusercontent.com',         // Your GitHub Client ID
		
		'client_secret' => 'mRyf5jExst_b3ZM5dkYKtDf_', // Your GitHub Client Secret
		
		'redirect' => 'http://localhost/LaravelLearning2/public/homesite/login/google/callback',
    ],	    
    
    'facebook' => [
        'client_id' => '165988420687268',         // Your GitHub Client ID
        'client_secret' => '6e435545e7ad9a717aa5a3cc8d94a7ea', // Your GitHub Client Secret
        'redirect' => 'http://localhost/LaravelLearning2/public/homesite/login/facebook/callback',
    ],
];
