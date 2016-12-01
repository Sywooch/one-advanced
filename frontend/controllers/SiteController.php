<?php
namespace frontend\controllers;

use common\models\Answers;
use common\models\AnswersPoll;
use common\models\CoachingStaff;
use common\models\Games;
use common\models\Players;
use common\models\Questions;
use common\models\SeasonDetails;
use common\models\Seasons;
use common\models\Teams;
use kartik\widgets\Alert;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\models\News;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-index';

        $data['questions'] = Questions::find()->where(['status' => 'on'])->orderBy('id DESC')->one();
        $data['answerPoll'] = AnswersPoll::find()->where([
            'quest_id' => $data['questions']->id,
            'ip' => $_SERVER['REMOTE_ADDR']
        ])->one();

        if (!empty($_POST)) {
            $model = new AnswersPoll();

            $dataPost = Yii::$app->request->post();
            $model->quest_id = $dataPost['question_id'];
            $model->answer_id = $dataPost['answer_id'];
            $model->ip = $_SERVER['REMOTE_ADDR'];
            $check = AnswersPoll::find()->where([
                'quest_id' => $model->quest_id,
                'ip' => $model->ip,
            ])->one();
            $model->date = time();
            $alertMessage = '';
            if ($model->save() && is_null($check)) {
                $modelAnswer = Answers::findOne($dataPost['answer_id']);
                $modelAnswer->how_many = $modelAnswer->how_many+1;
                $modelAnswer->save();
                $data['answerPoll'] = AnswersPoll::find()->where([
                    'quest_id' => $data['questions']->id,
                    'ip' => $_SERVER['REMOTE_ADDR']
                ])->one();
            } else {
                $alertMessage = Alert::widget([
                    'options' => [
                        'class' => 'alert-danger'
                    ],
                    'body' => '<b>Ошибка!</b> Ответ не был записан.',
                ]);
            }

            return $this->render('_poll', [
                    'answersData' => $data['questions']->answers,
                    'questions' => $data['questions'],
                    'answerPoll' => $data['answerPoll'],
                    'alertMessage' => $alertMessage,

                ]
            );
        }



        $dataProvider['news'] = new ActiveDataProvider([
            'query' => News::find()->where(['status_id'=>'on'])->orderBy('date_create DESC, id DESC')->limit(10),
            'pagination' => [
                'pageSize' => 11,
            ],
        ]);
        $data['mainTeam'] = Teams::find()->where(['name' => Yii::$app->params['main-team']])->one();
//        $CId = [2];
//        $CId = [3,2,7];
        $CId = [10];
        $allCoaches = CoachingStaff::find()
            ->where(['teams_id' => $data['mainTeam']->id])
            ->andWhere(['in', 'id' , $CId])
            ->all();
//        $PlId = [28,4,20,17];
        $PlId = [2];
        $allPlayers = Players::find()
//            ->select("*, DATE_FORMAT(FROM_UNIXTIME(`date`), '%d') as `date_day`,DATE_FORMAT(FROM_UNIXTIME(`date`), '%m') as `date_month`")
            ->where(['teams_id' => $data['mainTeam']->id])
            ->andWhere(['in', 'id' , $PlId])
//            ->andFilterWhere(['>=', "(date_format( FROM_UNIXTIME(`date` ), '%d-%m' ))", date('d.m')])
//            ->andWhere(['>', 'date', strtotime(date("01.m.Y 00:00:00"))])
//            ->andWhere(['<', 'date', strtotime(date("t.m.Y 23:59:59"))])
//            ->orderBy('date')
//            ->orderBy('date_month ASC, date_day ASC')
//            ->asArray()
//                ->limit(10)
            ->all();
        $data['allPlayers'] = [];
        foreach($allPlayers as $item) {
//            $allPlayers[$item->id] = $item;
            if ($item->id == 2) {
                $data['allPlayers'][1] = $item;
            }
//            if ($item->id == 28) {
//                $data['allPlayers'][1] = $item;
//            }
//            if ($item->id == 4) {
//                $data['allPlayers'][2] = $item;
//            }
//            if ($item->id == 20) {
//                $data['allPlayers'][3] = $item;
//            }
//            if ($item->id == 17) {
//                $data['allPlayers'][4] = $item;
//            }
        }
        foreach($allCoaches as $item) {
//            $data['allCoaches'][0] = $item;
            if ($item->id == 10) {
                $data['allCoaches'][0] = $item;
            }
//            if ($item->id == 3) {
//                $data['allCoaches'][0] = $item;
//            }
//            if ($item->id == 2) {
//                $data['allCoaches'][1] = $item;
//            }
//            if ($item->id == 7) {
//                $data['allCoaches'][2] = $item;
//            }
        }
//        ksort($data['allPlayers']);
//        ksort($data['allCoaches']);
//        ksort($data['allCoaches']);
//        $data['allPlayers'] = ksort($data['allPlayers']);
//        var_dump($data['allPlayers']);
//        var_dump(krsort($data['allPlayers']));

//        $data['allPlayers'][0] = $allPlayers[2];
//        var_dump($allPlayers);
//        die;
//        $data['allPlayers'][1] = $allPlayers[28];
//        $data['allPlayers'][2] = $allPlayers[4];
//        $data['allPlayers'][3] = $allPlayers[20];
//        $data['allPlayers'][4] = $allPlayers[17];


//        CaseMaster::find()->where(["DATE_FORMAT( FROM_UNIXTIME( i_date ),'%d-%m-%Y' )"=>date('d-m-Y')])->all();
//        DATE_FORMAT("2008-11-19",'%d.%m.%Y');
//        $sorted_articles=[];
//        foreach($articles as $article){
//            $dt=date('d.m.Y',$article->sort_date);
//            $sorted_articles[$dt][]=$article;
//        }
//        $data['allPlayers'] = [];
//        foreach($data['allPlayers'] as $item) {
//            var_dump(date('d.m.Y', $item->date));
////            var_dump($item['date_new']);
////            $item['new_date'] = $item->date;
////            $item->date = date('d.m', $item->date);
////            $dt = date('d.m', $item->date);
//            $data['allPlayers'][] = $item;
//        }
//        var_dump($data['allPlayers']);
        $data['seasonDetails'] = $data['mainTeam']->lastSeasonDetails;
        $data['season'] = $data['seasonDetails']->season;
        $dataProvider['standings'] = new ActiveDataProvider([
            'query' => SeasonDetails::find()
                ->where(['season_id' => $data['season']->id])
                ->orderBy('spectacles DESC')
                ->limit(20),
            'pagination' => false,
            'sort' =>false
        ]);

        $data['gameLast'] = Games::find()
            ->where(['home_id' => $data['mainTeam']->id])
            ->orWhere(['guest_id' => $data['mainTeam']->id])
            ->orderBy('date')
            ->one();
        $data['gameFirst'] = Games::find()
            ->where(['home_id' => $data['mainTeam']->id])
            ->orWhere(['guest_id' => $data['mainTeam']->id])
            ->orderBy('date DESC')
            ->one();
        $data['gamesLast'] = Games::find()
            ->where(['home_id' => $data['mainTeam']->id])
            ->orWhere(['guest_id' => $data['mainTeam']->id])
            ->andWhere(['<', 'date', time()-3600])
            ->orderBy('date DESC')
            ->limit(3)
            ->all();
        $data['gamesFirst'] = Games::find()
            ->where(['home_id' => $data['mainTeam']->id])
            ->orWhere(['guest_id' => $data['mainTeam']->id])
            ->andWhere(['>', 'date', time()-3600])
            ->orderBy('date')
            ->limit(3)
            ->all();

        $model = new AnswersPoll();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'data' => $data,
            'model' => $model,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDocuments()
    {
        $dir = glob('../web/files/documents/*');
        return $this->render('documents', ['data' => $dir]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

//    public function actionVote ()
//    {
//        if (!empty(Yii::$app->request->post())) {
//            $model = new AnswersPoll();
//
//            $dataPost = Yii::$app->request->post();
//            $model->quest_id = $dataPost['question_id'];
//            $model->answer_id = $dataPost['answer_id'];
//            $model->ip = $_SERVER['REMOTE_ADDR'];
//            $model->date = time();
//            if ($model->save()) {
//                $modelAnswer = Answers::findOne($dataPost['answer_id']);
//                $modelAnswer->how_many = $modelAnswer->how_many+1;
//                $modelAnswer->save();
//            }
//        }
//        if (!empty($_POST)) {

//        return Alert::widget();

//        return Alert::widget([
//            'options' => [
//                'class' => 'alert-danger'
//            ],
//            'body' => '<b>Ошибка!</b> Нет данных.'
//        ]);

//        return $this->redirect(['/#vote']);
//    }
}
