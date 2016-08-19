<?php
namespace backend\controllers;

use common\models\ClubQuestions;
use common\models\GuestBook;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
//                    [   'actions' => ['login'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'allow' => true,
//                        'roles' => ['admin'],
//                    ],
//                    [
//                        'allow' => false,
//                        'roles' => ['client','@'],
//                        'denyCallback' => function() { $this->redirect('/'); }
//                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = [];
        $dataProvider['guest-book'] = new ActiveDataProvider([
            'query' => GuestBook::find()->where(['status' => 'on'])->orderBy('date DESC')->limit(10),
        ]);
        $dataProvider['club-questions'] = new ActiveDataProvider([
            'query' => ClubQuestions::find()->where(['status' => 'on'])->orderBy('date DESC')->limit(10),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLogin()
    {
        $this->layout = 'login';

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
