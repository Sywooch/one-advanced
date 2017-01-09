<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;
/* @var $this yii\web\View */
/* @var $model common\models\Players */

$this->title = $model->name . ' ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => 'Игроки', 'url' => ['/players']];
$this->params['breadcrumbs'][] = $this->title;
//Icon::FI;
Icon::map($this, Icon::FI);
$roleInfo = ['вр' => 'Вратарь', 'зщ' => 'Защитник', 'пз' => 'Полузащитник', 'нп' => 'Нападающий', ];
?>

<div class="players-view">
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
                        <div class="player-number-img"><?php echo $model->number ?></div>
                        <div class="player-name-surname">
                            <?php echo $model->name . /*. ' ' . $model->patronymic .*/ ' ' . '<b>' . $model->surname . '</b>' ?>
                        </div>
                        <div class="player-role-nat">
                            <span class="player-role">
                                <?php echo $roleInfo[$model->role]; ?>
                            </span>
                            <?php
                            if ($model->nationality == 'РФ' || $model->nationality == 'Россия') {
                                echo Icon::show('ru', [], Icon::FI);
                            }
                            echo $model->nationality;
                            ?>
                        </div>
                    </div>
                    <div class="player-info">
                        <div class="player-info-box">
                            Рост
                            <div><?php echo $model->height ?></div>
                        </div>
                        <div class="player-info-box">
                            Вес
                            <div><?php echo $model->weight ?></div>
                        </div>
                        <div class="player-info-box">
                            Дата рождения
                            <div><?php echo Yii::$app->formatter->asDate($model -> date,'php: d.m.Y'); ?></div>
                        </div>
                    </div>
                    <div class="player-game-info">
                        <div class="player-info-box">
                            Игр
                            <div><?php echo $model->games ?></div>
                        </div>
                        <div class="player-info-box">
                            Голов
                            <div><?php echo $model->goals ?></div>
                        </div>
                        <div class="player-info-box">
                            <span class="player-info-box-label" data-toggle="tooltip" title="Жёлтых Карточек" data-placement="right" style="cursor: pointer">
                                <span class="player-info-cards yellow"></span><span>ЖК</span>
                            </span>
                            <div><?php echo $model->yellow_cards ?></div>
                        </div>
                    </div>
                    <div class="player-game-info">
                        <div class="player-info-box">
                            Минут
                            <div><?php echo $model->times ?></div>
                        </div>
                        <div class="player-info-box">
                            Передач
                            <div><?php echo $model->transfers ?></div>
                        </div>
                        <div class="player-info-box">
                            <span class="player-info-box-label" data-toggle="tooltip" title="Красных Карточек" data-placement="right" style="cursor: pointer">
                                <span class="player-info-cards red"></span><span>КК</span>
                            </span>
                            <div><?php echo $model->red_cards ?></div>
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
    <?php if($model->career || $model->career != '') : ?>
        <div class="player-content-block">
            <div class="row">
                <div class="col-xs-12">
                    <h2><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Карьера</h2>
                    <?php echo $model->career; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
