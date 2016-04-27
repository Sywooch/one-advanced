<?php
//var_dump($items);
use kartik\nav\NavX;

echo NavX::widget([
    'options'=>['class'=>'nav navbar-nav navbar-left menu-header-bottom'],
    'items' => $items,
    'activateParents' => true,
]);