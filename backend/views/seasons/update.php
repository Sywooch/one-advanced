<?php

use kartik\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\builder\TabularForm;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Seasons */
/* @var $searchModel common\models\TeamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Url::remember();

$this->title = 'Обновление Сезона: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сезоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="seasons-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    echo $this->render('_form', [
        'model' => $model,
    ]);

    $gridId = 'teams';
        echo $this->render('_grid', [
            'model' => $model,
            'dataProvider' => $dataProvider['teams'],
            'filterModel' => $searchModel['teams'],
            'gridOptions' => [
                'id' => $gridId,
                'panel' => [
                    'heading' => '<h4>Все команды</h4>',
                    'after' => Html::button(Html::icon('plus').' Добавить Команды в Сезон', [
                        'class' => 'btn btn-success perform-action', 'data-season' => $model->id, 'data-grid-id' => $gridId
                    ]),

                ],
                'columns' => [
                    ['class' => 'kartik\grid\CheckboxColumn'],
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
                    'name',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model) {
                            $url = Url::to(['teams/'.$action, 'id' => $model->id]);
                            return $url;
                        },
                        'template' => '{view} {update}',
                    ],
                ]
            ],
        ]);
    $gridId = 'sub-teams';
    echo $this->render('_grid', [
        'model' => $model,
        'dataProvider' => $dataProvider['seasonTeams'],
        'gridOptions' => [
            'id' => $gridId,
//                'team' => $model->home->name,
            'panel' => [
                'heading' => '<h4>Команды Сезона '.$model->name.'</h4>',
                'after' => false,

            ],
//                'team_id' => $model->home_id,
            'columns' => [
                [
                    'attribute' => 'team.name',
                    'label' => 'Имя',
                ],
                'games',
                'wins',
                 'draws',
                 'lesions',
                 'spectacles',
                 'goals_against',
                 'goals_scored',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function ($action, $model) {
                        $url = Url::to(['season-details/'.$action, 'id' => $model->id]);
                        return $url;
                    },
                    'template' => '{update}{delete-pjax}',
                    'buttons' => [
                        'delete-pjax' => function ($url, $model) {
                            return ' '.Html::a('<span class="glyphicon glyphicon-trash"></span>', false, [
                                'onclick' => 'deletePlayer('.$model->id.',\'/admin/season-details/delete-pjax\')',
                                'style' => 'cursor:pointer',
                                'title' =>'Удалить',
//                                'data-confirm'=>"Хотите удалить?",
                                'data-pjax'=>1
                            ]);
                        },
                    ]
                ],
            ]
        ],
    ]);

//    $form = ActiveForm::begin();
//    echo TabularForm::widget([
//        'dataProvider'=>$dataProvider['seasonTeams'],
//        'form'=>$form,
//        'options' => [
//            'id' => $gridId,
//        ],
//        'formName'=>'seasonTeams',
//        'gridSettings'=>[
//            'floatHeader'=>true,
//            'panel'=>[
//                'heading' => '<h4>Команды Сезона '.$model->name.'</h4>',
//                'type' => GridView::TYPE_DEFAULT,
//                'after'=> Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Сохранить', ['class'=>'btn btn-primary']),
//                'before' => false
//            ]
//        ],
//        'attributes'=>[
//            // primary key column
////            'id'=>[ // primary key attribute
////                'type'=>TabularForm::INPUT_HIDDEN,
////                'columnOptions'=>['hidden'=>true]
////            ],
//            'team_id'=>[
//                'type'=>TabularForm::INPUT_STATIC,
//                'label'=>'Команда',
////                'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px'],
//                'value' => function ($model) {
//                    return $model->team->name;
//                }
//            ],
//            'games'=>['type'=>TabularForm::INPUT_TEXT],
//            'wins'=>['type'=>TabularForm::INPUT_TEXT],
//            'draws'=>['type'=>TabularForm::INPUT_TEXT],
//            'lesions'=>['type'=>TabularForm::INPUT_TEXT],
//            'spectacles'=>['type'=>TabularForm::INPUT_TEXT],
//            'goals_against'=>['type'=>TabularForm::INPUT_TEXT],
//            'goals_scored'=>['type'=>TabularForm::INPUT_TEXT],
//
////            'publish_date'=>[
////                'type' => function($model, $key, $index, $widget) {
////                    return ($key % 2 === 0) ? TabularForm::INPUT_HIDDEN : TabularForm::INPUT_WIDGET;
////                },
////                'widgetClass'=>\kartik\widgets\DatePicker::classname(),
////                'options'=> function($model, $key, $index, $widget) {
////                    return ($key % 2 === 0) ? [] :
////                        [
////                            'pluginOptions'=>[
////                                'format'=>'yyyy-mm-dd',
////                                'todayHighlight'=>true,
////                                'autoclose'=>true
////                            ]
////                        ];
////                },
////                'columnOptions'=>['width'=>'170px']
////            ],
////            'color'=>[
////                'type'=>TabularForm::INPUT_WIDGET,
////                'widgetClass'=>\kartik\widgets\ColorInput::classname(),
////                'options'=>[
////                    'showDefaultPalette'=>false,
////                    'pluginOptions'=>[
////                        'preferredFormat'=>'name',
////                        'palette'=>[
////                            [
////                                "white", "black", "grey", "silver", "gold", "brown",
////                            ],
////                            [
////                                "red", "orange", "yellow", "indigo", "maroon", "pink"
////                            ],
////                            [
////                                "blue", "green", "violet", "cyan", "magenta", "purple",
////                            ],
////                        ]
////                    ]
////                ],
////                'columnOptions'=>['width'=>'150px'],
////            ],
//
////            'author_id'=>[
////                'type'=>TabularForm::INPUT_DROPDOWN_LIST,
////                'items'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
////                'columnOptions'=>['width'=>'185px']
////            ],
//            /*
//            'buy_amount'=>[
//                'type'=>TabularForm::INPUT_TEXT,
//                'label'=>'Buy',
//                'options'=>['class'=>'form-control text-right'],
//                'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
//            ],
//            */
////            'attribute' => 'team.name',
//
//
//        ]
//    ]);
//    // Add other fields if needed or render your submit button
//    echo '<div class="text-right">' .
//        Html::submitButton('Submit', ['class'=>'btn btn-primary']) .
//        '<div>';
//    ActiveForm::end();
    ?>

</div>

<?php
$this->registerJsFile('@web/js/addMany_deleteOne.js', ['depends' => ['yii\web\YiiAsset'],'position' => \yii\web\View::POS_END]);