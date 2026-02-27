<?php
/**
 * Главная конфигурация Yii2 (Basic).
 *
 * Этот файл собирает параметры приложения и описывает компоненты/модули,
 * которые будут доступны через `Yii::$app`.
 *
 * Обычно сюда попадают:
 * - идентификатор приложения и базовые настройки
 * - компоненты (db, cache, user, mailer, log, urlManager и т.д.)
 * - настройки окружения (dev/prod) и подключение модулей debug/gii
 *
 * @see https://www.yiiframework.com/doc/guide/2.0/en/start-hello
 */

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';

/**
 * Конфигурация приложения.
 *
 * @var array<string, mixed> $config
 */
$config = [
    /**
     * Уникальный идентификатор приложения.
     * Используется внутри Yii, например для построения путей/логов и т.п.
     */
    'id' => 'basic',

    /**
     * Маршрут по умолчанию (контроллер/экшен), если не указан другой.
     * Например: site/index, request/index и т.д.
     */
    'defaultRoute' => 'request/index',

    /**
     * Базовый путь приложения (корень проекта).
     */
    'basePath' => dirname(__DIR__),

    /**
     * Компоненты/модули, которые должны быть загружены на старте.
     * Здесь — логирование.
     */
    'bootstrap' => ['log'],

    /**
     * Алиасы (псевдонимы путей), чтобы удобно ссылаться на каталоги.
     */
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    /**
     * Компоненты приложения (доступны как Yii::$app->componentName).
     */
    'components' => [
        /**
         * Компонент HTTP-запроса.
         * cookieValidationKey — обязателен для защиты cookies от подмены.
         */
        'request' => [
            // ВАЖНО: замените на свой секретный ключ в реальном проекте
            // (особенно если репозиторий публичный).
            'cookieValidationKey' => 'w9LvsECI-HDFBi5O-u3LeMjZG7aknx61',
        ],

        /**
         * Кэширование (файловый кэш).
         * Подходит для dev/малых проектов.
         */
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        /**
         * Компонент аутентификации/пользователя.
         * identityClass — модель, реализующая IdentityInterface.
         */
        'user' => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true, // "запомнить меня" через cookie
        ],

        /**
         * Глобальный обработчик ошибок.
         * errorAction — куда перенаправлять при исключениях/ошибках.
         */
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        /**
         * Почтовый компонент.
         * useFileTransport=true — письма пишутся в файл (без отправки),
         * удобно в разработке.
         */
        'mailer' => [
            'class'    => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // По умолчанию не отправляем реально, а сохраняем в runtime/mail
            'useFileTransport' => true,
        ],

        /**
         * Логирование.
         * traceLevel выше в dev помогает видеть стек вызовов.
         */
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        /**
         * Подключение базы данных из отдельного файла db.php.
         * Обычно там DSN, логин/пароль, charset и т.п.
         */
        'db' => $db,

        /**
         * URL Manager — “красивые” URL и правила маршрутизации.
         *
         * enablePrettyUrl=true  -> /controller/action вместо /index.php?r=...
         * showScriptName=false  -> скрывает index.php в URL
         * rules — таблица преобразования URL -> route
         */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules' => [
                /**
                 * Главная страница сайта.
                 * Пустой путь ('') будет вести на request/index.
                 */
                '' => 'request/index',

                /**
                 * Общий маршрут: /controller/action
                 */
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

                /**
                 * Маршрут с числовым id: /controller/action/123
                 *
                 * Примечание:
                 * Сейчас справа указано '<controller>/<action>' (без id).
                 * Yii всё равно подхватит параметр id из URL,
                 * но обычно пишут '<controller>/<action>' и так ок,
                 * или явно: '<controller>/<action>' (id попадёт в $_GET).
                 */
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
    ],

    /**
     * Параметры приложения из params.php (например email админа и т.п.)
     */
    'params' => $params,
];

/**
 * Настройки окружения разработки.
 *
 * В dev-режиме подключаем:
 * - debug: панель отладки Yii
 * - gii: генератор кода
 */
if (YII_ENV_DEV) {
    // Подключаем модуль debug
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        /**
         * Можно ограничить доступ по IP.
         * Раскомментируйте и добавьте свой IP, если нужно.
         */
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    // Подключаем модуль gii
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        /**
         * Можно ограничить доступ по IP.
         */
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;