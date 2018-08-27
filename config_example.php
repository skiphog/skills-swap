<?php

return [
    /**
     * Имя приложения
     */
    'domain' => 'example', // skills-swap.ru

    /**
     * Использовать HTTPS в куках
     */
    'secure' => false,

    /**
     * Подключение к бд
     */
    'db' => [
        'host'     => '127.0.0.1',
        'dbname'   => 'example',
        'username' => 'example',
        'password' => 'example',
        'options'  => [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            //\PDO::ATTR_EMULATE_PREPARES  => false,
            //\PDO::ATTR_STRINGIFY_FETCHES => false
        ]
    ],

    /**
     * Кеш
     */
    'cache' => [
        'driver' => \System\Cache\FileDriver::class,
        'path'   => __DIR__ . '/cache'
    ],

    /**
     * Шаблоны
     */
    'view' => [
        'path' => __DIR__ . '/template'
    ],

    /**
     * Основной email
     */
    'mail' => 'example@example.com'
];
