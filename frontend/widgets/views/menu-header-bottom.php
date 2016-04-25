<?php
//var_dump($items);
use kartik\nav\NavX;

echo NavX::widget([
    'options'=>['class'=>'nav nav-pills'],
    'items' => $items,
    'activateParents' => true,
]);