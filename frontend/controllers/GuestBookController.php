<?php

namespace frontend\controllers;

use common\models\BlackList;
use common\models\GuestBookSearch;
use common\models\User;
use kartik\widgets\Alert;
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
            $url ='http://freegeoip.net/json/';
            $ch = curl_init();
            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
            // Execute
            $result=curl_exec($ch);
            // Closing
            curl_close($ch);
            // Will dump a beauty json :3
            $ipDetails = json_decode($result, true);

            if (!is_null($ipDetails)) {
                $model->ip = $ipDetails['ip'];
            } else {
                $model->ip = 'NULL';
            }
            $query = BlackList::find()->where(['email'=>$model->email])->orWhere(['ip'=>$model->ip]);
            if (!Yii::$app->user->isGuest) {
                $query->orWhere(['user_id'=>$model->ip]);
            }
//            $query->one();
            $blacklistedCheck = $query->one();
            if (is_null($blacklistedCheck)) {


//            $blacklistedCheck = BlackList::find()
//                ->where(['email'=>$model->email])
//                ->orWhere(['ip'=>$model->ip])
//                ->orWhere(['user_id'=>$model->ip])
//                ->one();

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
//                    echo Alert::widget([
//                        'options' => [
//                            'class' => 'alert-success'
//                        ],
//                        'body' => '<b>Успешно!</b> Ваша запись опубликованна.'
//                    ]);
                } else {
                    var_dump($model->errors);
                    exit();
                }
            } else {
                return Alert::widget([
                    'options' => [
                        'class' => 'alert-danger'
                    ],
                    'body' => '<b>Ошибка!</b> Вы в чёрном списке.'
                ]);
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => GuestBook::find()->where(['status' => 'on'])->orderBy('date DESC'),
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
