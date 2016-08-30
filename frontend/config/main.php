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
    'bootstrap' => ['log', 'maintenance'],
    'modules' => [
        'maintenance' => [
            'class' => 'app\modules\maintenance\Module',
        ]
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => '',
            'enableCsrfValidation'=>false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,

            'rules' => [
                [
                    'pattern' => '/page/<slug:\S+>',
                    'route' => '/pages/show-page',
                    'defaults' => ['slug' => 'error']
                ],
                'news' => 'news/index',
                [
                    'pattern' => 'news/<slug:\S+>',
                    'route' => '/news/view',
                ],
                [
                    'pattern' => 'players/view/<id:\w+>',
                    'route' => '/players/view',
                ],
                'season/tournament' => 'season-details',
                'person/administrations' => 'coaching-staff/administrations',
                'person/coaches' => 'coaching-staff/coaches',
                [
                    'pattern' => 'person/<category:\S+>/<id:\w+>',
                    'route' => '/coaching-staff/view',
                ],
                'documents' => 'site/documents',

//                'coaches' => 'coaching-staff',
//                'coaches/<action:(index|create|update|delete)>' => 'coaching-staff/<action>',
//                'season/tournament' => 'season-details/index',

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
////        ],
//        'assetManager' => [
//            'bundles' => [
//                'edgardmessias\assets\nprogress\NProgressAsset' => [
//                    'configuration' => [
//                        'minimum' => 0.08,
//                        'showSpinner' => true,
//                    ],
//                    'page_loading' => false,
//                    'pjax_events' => true,
//                    'jquery_ajax_events' => false,
//                ],
//            ],
//        ],
    ],
    'params' => $params,
];
