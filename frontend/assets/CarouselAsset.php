<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class CarouselAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/jquery.circular-carousel.css',
    ];
    public $js = [
        'js/jquery.circular-carousel.js',
        'js/carousel.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
