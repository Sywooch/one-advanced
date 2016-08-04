<?php

namespace frontend\controllers;

use common\models\BlackList;
use common\models\ClubQuestions;
use common\models\ClubQuestionsSearchSearch;
use common\models\Teams;
use common\models\User;
use kartik\widgets\Alert;
use Yii;
use common\models\ClubQuestionsSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClubQuestionsSearchController implements the CRUD actions for ClubQuestionsSearch model.
 */
class ClubQuestionsController extends Controller
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
     * Lists all ClubQuestionsSearch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ClubQuestions();
        $data['mainTeam'] = Teams::find()->where(['name' => Yii::$app->params['main-team']])->with('players')->with('coachingStaff')->one();
        if ($model->load(Yii::$app->request->post()))
        {
//            var_dump($model);die;
            $ip = $_SERVER['REMOTE_ADDR'];
            if (isset($ip)) {
                $model->ip = $ip;
            } else {
                $model->ip = 'NULL';
            }
//            $query = BlackList::find()->where(['email'=>$model->email])->orWhere(['ip'=>$model->ip]);
//            if (!Yii::$app->user->isGuest) {
//                $query->orWhere(['user_id'=>$model->ip]);
//            }
//            $blacklistedCheck = $query->one();
//            if (is_null($blacklistedCheck)) {

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
                    $model = new ClubQuestions();
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
//            } else {
//                return Alert::widget([
//                    'options' => [
//                        'class' => 'alert-danger'
//                    ],
//                    'body' => '<b>Ошибка!</b> Вы в чёрном списке.'
//                ]);
//            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => ClubQuestions::find()->where(['status' => 'on'])->orderBy('date DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'data' => $data,
        ]);
    }
}
