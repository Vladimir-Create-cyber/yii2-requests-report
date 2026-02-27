<?php

return [
    'class' => 'yii\db\Connection',

    // Postgres из docker-compose (сервис db)
    'dsn' => 'pgsql:host=db;port=5432;dbname=app',

    'username' => 'app',
    'password' => 'app',

    'charset' => 'utf8',
];