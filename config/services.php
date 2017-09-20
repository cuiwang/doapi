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

    #新增
    'weibo' => [
        'client_id' => '1157166663',
        'client_secret' => 'c67c74c17d7af98c4dc37765a7ec1974',
        'redirect' => 'http://doapi.cn/auth/callback'
    ],
    'weixin' => [
        'client_id'     => env('wxf2d9d9013049b319'),
        'client_secret' => env('f67aa2597d1bb509baf6312d54c813f9'),
        'redirect'      => env('WEIXIN_REDIRECT_URI'),

        # 这一行配置非常重要，必须要写成这个地址。
        'auth_base_uri' => 'https://open.weixin.qq.com/connect/qrconnect',
    ],
    //https://connect.qq.com/manage.html#/appinfo/web/101345390 41612021
    'qq' => [
        'client_id' => '101345390',
        'client_secret' => '9b18d21d6fc596752ad498ca635bdd25',
        'redirect' => 'http://doapi.cn/auth/qq_callback',
    ],

];
