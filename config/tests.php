<?php

return [

    'app' => [
        '__class' => \yii\console\Application::class,
        'bootstrap' => [
            'mysqlQueue',
        ],
        'controllerMap' => [
            'mysql-migrate' => [
                '__class'             => \yii\console\controllers\MigrateController::class,
                'db'                  => 'mysql',
                'migrationPath'       => null,
                'migrationNamespaces' => [
                    'Yiisoft\Yii\Queue\Drivers\Db\migrations',
                ],
            ],
            'sqlite-migrate' => [
                '__class'             => \yii\console\controllers\MigrateController::class,
                'db'                  => 'sqlite',
                'migrationPath'       => null,
                'migrationNamespaces' => [
                    'Yiisoft\Yii\Queue\Drivers\Db\migrations',
                ],
            ],
            'pgsql-migrate' => [
                '__class'             => \yii\console\controllers\MigrateController::class,
                'db'                  => 'pgsql',
                'migrationPath'       => null,
                'migrationNamespaces' => [
                    'Yiisoft\Yii\Queue\Drivers\Db\migrations',
                ],
            ],
            'benchmark' => \Yiisoft\Yii\Queue\Tests\app\benchmark\Controller::class,
        ],
    ],
    'request' => [
        '__class' => \yii\console\Request::class,
        'cookieValidationKey' => new \Yiisoft\Arrays\UnsetArrayValue(),
        'scriptFile' => dirname(__DIR__) . '/tests/yii',
        'scriptUrl' =>  new \Yiisoft\Arrays\UnsetArrayValue(),
    ],
    'response' => [
        '__class' => \yii\console\Response::class,
        'formatters' =>  new \Yiisoft\Arrays\UnsetArrayValue(),
    ],
    'errorHandler' => [
        '__class' => \yii\console\ErrorHandler::class,
    ],
    'aliases' => [
        '@runtime' => dirname(__DIR__) . '/tests/runtime',
    ],
    'syncQueue' => [
        '__class' => \Yiisoft\Yii\Queue\Drivers\Sync\Queue::class,
    ],
    \yii\db\ConnectionInterface::class => \yii\di\Reference::to('mysql'),
    'mysql' => [
        '__class' => \yii\db\Connection::class,
        'dsn' => sprintf(
            'mysql:host=%s;dbname=%s',
            getenv('MYSQL_HOST') ?: 'localhost',
            getenv('MYSQL_DATABASE') ?: 'yii2_queue_test'
        ),
        'username' => getenv('MYSQL_USER') ?: 'root',
        'password' => getenv('MYSQL_PASSWORD') ?: 'password',
        'charset' => 'utf8',
        'attributes' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode = "STRICT_ALL_TABLES"',
        ],
    ],
    'pdo' => [
        '__class' => \PDO::class,
        '__construct()' => [
            'dsn' => 'mysql:dbname=yiitest',
            'username' => 'root',
            'password' => 'password',
            'options' => [
            ],
        ],
    ],
    \Yiisoft\Mutex\Mutex::class => \yii\di\Reference::to(\Yiisoft\Mutex\MysqlMutex::class),
    'mysqlQueue' => [
        '__class' => \Yiisoft\Yii\Queue\Drivers\Db\Queue::class,
    ],
    /* 'sqlite' => [
         '__class' => \yii\db\Connection::class,
         'dsn'   => 'sqlite:@runtime/yii2_queue_test.db',
     ],
     'sqliteQueue' => [
         '__class' => \Yiisoft\Yii\Queue\Drivers\Db\Queue::class,
         'db'    => 'sqlite',
         'mutex' => \Yiisoft\Mutex\FileMutex::class,
     ],
     'pgsql' => [
         '__class' => \yii\db\Connection::class,
         'dsn'   => sprintf(
             'pgsql:host=%s;dbname=%s',
             getenv('POSTGRES_HOST') ?: 'localhost',
             getenv('POSTGRES_DB') ?: 'yii2_queue_test'
         ),
         'username' => getenv('POSTGRES_USER') ?: 'postgres',
         'password' => getenv('POSTGRES_PASSWORD') ?: '',
         'charset'  => 'utf8',
     ],
     'pgsqlQueue' => [
         '__class' => \Yiisoft\Yii\Queue\Drivers\Db\Queue::class,
         'db'    => 'pgsql',
         'mutex' => [
             '__class' => \Yiisoft\Mutex\PgsqlMutex::class,
             'db'    => 'pgsql',
         ],
         'mutexTimeout' => 0,
     ],*/
];