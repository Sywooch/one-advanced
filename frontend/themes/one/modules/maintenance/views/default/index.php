<?php
use yii\helpers\Html;
use kartik\icons\Icon;

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
    <div class="social">
        <a href="https://vk.com/fcbaltika" target="_blank"><span class="social-img vk"></span></a>
        <a href="https://www.facebook.com/fcbaltika" target="_blank"><span class="social-img facebook"></span></a>
        <a href="https://twitter.com/fcbaltika" target="_blank"><span class="social-img twitter"></span></a>
        <a href="http://www.youtube.com/user/fcbaltika" target="_blank"><span class="social-img youtube"></span></a>
        <a href="https://www.instagram.com/fcbaltika/" target="_blank"><span class="social-img instagramm"></span></a>
    </div>
<!--    Извините, в настоящее время на сайте производятся профилактические работы!-->
</div>
