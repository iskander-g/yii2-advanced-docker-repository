<?php

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=',
            'username' => '',
            'password' => '',
            'charset' => 'utf8mb4',
        ],
        'mailer' => [
            'class' => 'sweelix\postmark\Mailer',
            'token' => '', // your postmark token
        ],
        'turnstile' => [
            'class' => 'easedevs\yii2\turnstile\TurnstileConfig',
            'siteKey' => '',
            'secret' => '',
        ],
    ],
];
