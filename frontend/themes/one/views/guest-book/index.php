<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Гостевая книга';
$this->params['breadcrumbs'][] = $this->title;

$this->params['headerName'] = $this->title;
$this->params['image_page'] = '/themes/one/src/layout/guest.png';


?>
<div class="guest-book-index">
    <h1><?php echo $this->title ?></h1>
    <?php
    if(!Yii::$app->user->isGuest) {
        echo $this->render('_form',[
            'model' => $model,
        ]);
    } else {
        ?>
        <p>Для общения на гостевой Вы должны быть зарегистрирвоаны на нашем сайте!</p>
        <p>
            <a href="/site/login" class="btn btn-primary">Вход</a>
            <a href="/site/signup" class="btn btn-primary">Регистрация</a>
        </p>
        <?php
    }
    ?>
<?php Pjax::begin(['id' => 'guest_records']); ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
//            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
            return $this->render('_list',['model' => $model, 'index' => $index]);
        },
    ]) ?>
<?php Pjax::end(); ?></div>
