<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/main.css',
        '//fonts.googleapis.com/css?family=Exo+2:400,700,400italic'
//        <link href='https://fonts.googleapis.com/css?family=Exo:400,700,400italic' rel='stylesheet' type='text/css'>
    ];
    public $js = [
        'js/main.js',
        'https://kgd.kassir.ru/start.js?ver=1.0',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
