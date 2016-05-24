<?php

namespace frontend\controllers;

use Yii;
use common\models\Pages;
use common\models\PagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
{

    public $defaultAction = 'show-page';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionShowPage($slug = 'error') {
//        var_dump($this->defaultAction);
//        var_dump($slug);

//        Yii::app()->clientScript->registerMetaTag($model->description, 'description');
//        Yii::app()->clientScript->registerMetaTag($model->keywords, 'keywords');

        if (($model = Pages::find()->where(['slug' => $slug])->one()) !== null) {
            return $this->render('showPage', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
