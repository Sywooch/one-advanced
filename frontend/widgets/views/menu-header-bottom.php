<?php
//var_dump($items);
use kartik\nav\NavX;

echo NavX::widget([
    'options'=>['class'=>'nav nav-pills menu-header-bottom'],
    'items' => $items,
    'activateParents' => true,
]);