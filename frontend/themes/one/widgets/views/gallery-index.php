<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<a href="<?php echo Url::toRoute('/gallery'); ?>" class="pull-right">Все фото</a>
<h4>Галерея</h4>
<?php
foreach ($model as $item) {
    ?>
    <div class="row">
        <div class="col-xs-12">
            <h5><a href="<?php echo Url::to(['/gallery/view', 'id' => $item->id]); ?>"><?php echo $item->name ?></a></h5>
            <div class="gallery-view-block">
            <?php
                $images = $item->getImages();
                if($images[0]['urlAlias']!='placeHolder') {
                    $i = 0;
                    foreach($images as $img){
                        $class = ['target' => '_blank'];
                        $imgExtension = pathinfo($img->filePath)['extension'];
                        if ($imgExtension != '') {
                            $class = ['class' => 'lightbox'];
                        }
                        $i++;
                        if ($i == 4) {
                            break;
                        }
                        echo Html::tag(
                            'div',
                            Html::a(
                                Html::img($img->getUrl('100x100'),['alt' => $item->name, 'class' => 'gallery-home-img']),
                                $img->getUrl(),$class
                            ),
                            ['class' => 'gallery-view-box']
                        );
                    }
                }
            ?>
            </div>
        </div>
    </div>
    <?php
}
?>
