<?php

namespace frontend\controllers;

use common\models\GuestBookSearch;
use common\models\User;
use Yii;
use common\models\GuestBook;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GuestBookController implements the CRUD actions for GuestBook model.
 */
class GuestBookController extends Controller
{
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

    /**
     * Lists all GuestBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new GuestBook();
        if ($model->load(Yii::$app->request->post()))
        {
            $ipDetails = json_decode(file_get_contents('http://freegeoip.net/json/'));
            if (!empty($ipDetails)) {
                $model->ip = $ipDetails->ip;
            } else {
                $model->ip = 'NULL';
            }
            $model->date = time();
            $model->status = 'on';
            if (Yii::$app->user->isGuest) {
                $model->user_id = 0;
            } else {
                $model->user_id = Yii::$app->user->identity->id;
                $userDetails = User::findOne($model->user_id);
                $model->name = $userDetails['username'];
                $model->email = $userDetails['email'];
            }

            if ($model->save()) {
                $model = new GuestBook();
            } else {
                var_dump($model->errors);
                exit();
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => GuestBook::find()->orderBy('date DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }
}
