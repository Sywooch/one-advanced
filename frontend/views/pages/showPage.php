<?php
if(isset($model->meta_title) and !empty($model->meta_title)) { $this->title = $model->meta_title; }
if(isset($model->meta_keywords) and !empty($model->meta_keywords)) { $this->registerMetaTag(['name' => 'keywords','content' => $model->meta_keywords]); }
if(isset($model->meta_descr) and !empty($model->meta_descr)) { $this->registerMetaTag(['name' => 'description','content' => $model->meta_descr]); }

$this->params['breadcrumbs'][] = $model->name;

$image = $model->getImage();

$this->params['widget_bar'] = $model->widget_bar;
if ($image->urlAlias != 'placeHolder') {
    $this->params['image_page'] = $image->getUrl();
}



?>
<?php
?>

<div class="page-<?php echo $model->slug?>">
    <h1><?php echo $model->name ?></h1>
    <?php echo $model->content ?>
</div>
