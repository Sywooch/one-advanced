<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'homeUrl' => '/',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/themes/one/views',
                    '@app/widgets' => '@app/themes/one/widgets',
                ],

            ],
        ],
        'request' => [
            'baseUrl' => '',
            'enableCsrfValidation'=>false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,

            'rules' => [
                [
                    'pattern' => 'page/<slug:\S+>',
                    'route' => '/pages/show-page',
                    'defaults' => ['slug' => 'error']
                ],
//                '/site/index' => '/',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
//            'authTimeout' => 36000,
//            'absoluteAuthTimeout' =>36000
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'assetManager' => [
//            'appendTimestamp' => true,
//        ],
    ],
    'params' => $params,
];
