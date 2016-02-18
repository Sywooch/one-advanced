<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Update News: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$this->registerJsFile('js/remove_image.js');

?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    <div class="row">-->
<!--            <a href="#" class="">-->
<!--                <img data-src="holder.js/100%x180" alt="...">-->
<!--            </a>-->

    <?php

    $images = $model->getImages();
    if($images[0]['urlAlias']!='placeHolder') {
        echo Html::beginTag('div',['class' => 'well']);
        echo Html::beginTag('div',['class' => 'row']);

//        echo '<h5>Images</h5>';
//        <a
//        href="/admin/yii2images/images/image-by-item-and-alias?item=QtpCategory14&amp;dirtyAlias=d33e258ebd-1."
//        data-lightbox="catid_14">
//        <img
//        src="/admin/yii2images/images/image-by-item-and-alias?item=QtpCategory14&amp;dirtyAlias=d33e258ebd-1_x200."
//        class="img-thumbnail">
//        </a>
//        var_dump();
        foreach($images as $img){
            echo Html::beginTag('div',['class' => 'col-xs-6']);
                echo Html::a(
                    Html::img($img->getUrl('x100'),['alt' => $model->title]),
                    false,
//                    $img->getUrl(),
                    [
                        'class' => 'thumbnail',
//                        'onclick' => '$(#id_'.$img->id.').modal({ remote: '.$img->getUrl().' })',
//                        ="#myModal"
//                        'target' => '_blank',
//                        'data-toggle' => 'modal',
//                        'data-target' => '#id_'.$img->id,
//                        'href' => $img->getUrl()
                    ]
                );
//                Html::tag(
//                    'a',
//                    Html::img($img->getUrl('x100',['alt' => $model->title])),
//                    [
//                        'href' => $img->getUrl(),
//                        'class' =>
//                    ]
//                );

                    if(!$img->isMain) {
                        $columns = 4;
                        echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
//                            echo Html::a('Setmain', Yii::$app->request->url.'&newmainimg='.$img->id, ['class' => 'btn  btn-success']);
                            echo Html::a('Setmain', ['set-main', 'id'=> $model->id,'id_img'=>$img->id], ['class' => 'btn  btn-success']);
                        echo Html::endTag('div');
                    } else {
                        $columns = 6;
                    }
                    echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
                        echo Html::a('View', $img->getUrl(), ['class' => 'btn  btn-primary','target' => '_blank']);
                    echo Html::endTag('div');
                    echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
                        echo Html::a('Remove', ['remove-image', 'id'=> $model->id], ['class' => 'btn  btn-danger']);
                    echo Html::endTag('div');
            echo Html::endTag('div');
        }
        echo Html::endTag('div');
        echo Html::endTag('div');
    }

//    foreach($images as $img){

//            echo Html::tag(
//                'div',
//                Html::img($img->getUrl('x200'))
//                );
//            echo '<div class="imagecontrol" id="image_'.$img->id.'">
//                        <img src="'.$img->getUrl('x100').'" ><div class="btns"><a href="#" onclick="ImageDelete('.$img->id.')">remove</a><br>';
//            if(!$img->isMain) {
//                echo '<a href="'.Yii::$app->request->url.'&newmainimg='.$img->id.'">setmain</a><br>';
//            }
//            echo '</div>';
//    }

    ?>
<!--    </div>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>