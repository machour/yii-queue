<?php

use yii\di\Reference;

return [
    'app' => [
        'bootstrap' => [
            'queue' => 'queue',
        ],
    ],
    \PDO::class => Reference::to('pdo'),
    'pdo'       => [
        '__class'       => \PDO::class,
        '__construct()' => [
            'dsn'       => 'pgsql:dbname='.$params['db.name']
                .(!empty($params['db.host']) ? (';host='.$params['db.host']) : '')
                .(!empty($params['db.port']) ? (';port='.$params['db.port']) : ''),
            'username'  => $params['db.user'],
            'password'  => $params['db.password'],
            'options'   => [],
        ],
    ],
    \Yiisoft\Mutex\Mutex::class => Reference::to('mutex'),
    'mutex'                 => [
        '__class' => \Yiisoft\Mutex\MysqlMutex::class,
    ],
];
