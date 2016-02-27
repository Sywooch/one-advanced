<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TeamsSearchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Команды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teams-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать Команду', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'Логотип',
                'format' => 'raw',
                'value' => function($data){
                    $images = $data->getImages();
                    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
                        $image = $data->getImage();
                        $sizes = $image->getSizesWhen('x25');
                        return Html::img($image->getUrl('x25'),[
                            'alt'=>'yii2 - картинка в gridview',
                            'class' => 'img-responsive',
                            'width'=>$sizes['width'],
                            'height'=>$sizes['height']
                        ]);
                    }
                },
            ],
            'id',
            'name',
            'slug',
//            'year',
//            'web_site',
            // 'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
