<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CoachingStaff */

$this->title = $model->surname . ' ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Просмотр', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaching-staff-view players-view">
    <div class="players-view-block">
        <div class="row">
            <div class="col-xs-5 text-center player-img-block">
                <div class="player-img-box">
                    <?php
                    $images = $model->getImage();
                    if($images['urlAlias']!='placeHolder') {
                        echo Html::img($images->getUrl('x400'), ['alt' => $model->name, 'class' => '']);//thumbnail img-responsive
                    }
                    ?>
                </div>
            </div>
            <div class="col-xs-7 player-info-block">
                <div class="player-info-subblock">
                    <div class="player-name-info">
<!--                        <div class="player-number-img">--><?php //echo $model->number ?><!--</div>-->
                        <div class="player-name-surname">
                            <?php echo $model->name . ' ' . $model->patronymic . ' ' . '<b>' . $model->surname . '</b>' ?>
                        </div>
                        <div class="player-role-nat">
                        <span class="player-role">
                            <?php echo $model->role; ?>
                        </span>
                        </div>
                    </div>
                    <div class="player-info">
                        <div class="player-info-box">
                            Дата рождения
                            <div><?php echo Yii::$app->formatter->asDate($model -> date,'php: d.m.Y'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($model->content || $model->content != '') : ?>
        <div class="player-content-block">
            <div class="row">
                <div class="col-xs-12">
                    <h2><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Биография</h2>
                    <?php echo $model->content; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
