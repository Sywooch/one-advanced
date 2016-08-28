<?php
return [
    'language' => 'ru-RU',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//    'sourceLanguage' => 'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'urlManager' => [
//            'enablePrettyUrl' => true,
//        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['admin','client'],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:d.m.Y H:i',
            'timeFormat' => 'php:H:i',
//            'defaultTimeZone' => 'Europe/Moscow',
            'defaultTimeZone' => 'Europe/Kaliningrad',
            'locale' => 'ru-RU'
        ],
    ],
    'modules' => [
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => '@frontend/web/images/store', //path to origin images @frontend/web/
            'imagesCachePath' => '@frontend/web/images/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => '@webroot/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
//        'Poll' => [
//            'name' => 'yiisoft/yii2-poll',
//            'alias' =>[
//                    '@pollext/poll' => $vendorDir . '/yiisoft/yii2-poll',
//                ],
//
//        ]

    ],
];
