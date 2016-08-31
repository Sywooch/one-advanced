<?php
use yii\helpers\Html;

/* @var $message string */

?>
<div class="maintenance-default-index">
<!--    --><?php //echo \yii\helpers\HtmlPurifier::process($message) ?>
    <div class="logo-text">
        <div class="logo"><?php echo Html::img('@web/themes/one/src/logo.png'); ?></div>
        <div class="text">
            <div>Футбольный клуб</div>
            <div>Балтика Калининград</div>
        </div>
    </div>
    <div class="image">
        <div class="image-block">
            <?php echo Html::img('@web/themes/one/src/zagl-fc-baltika.png'); ?>
            <div class="image-descr">
                <div class="image-descr-block">
                    <div class="one">:-(</div>
                    <div class="two">Сайт временно недоступен</div>
                    <div class="three">Ведутся технические работы по обновлению ресурса</div>
                </div>
            </div>
        </div>
    </div>
<!--    Извините, в настоящее время на сайте производятся профилактические работы!-->
</div>
