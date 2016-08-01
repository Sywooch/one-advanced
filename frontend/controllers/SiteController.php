<?php
namespace frontend\controllers;

use common\models\AnswersPoll;
use common\models\Games;
use common\models\Players;
use common\models\Questions;
use common\models\SeasonDetails;
use common\models\Seasons;
use common\models\Teams;
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

        $dataProvider['news'] = new ActiveDataProvider([
            'query' => News::find()->where(['status_id'=>'on'])->orderBy('date_create DESC')->limit(10),
            'pagination' => [
                'pageSize' => 7,
            ],
        ]);
        $data['mainTeam'] = Teams::find()->where(['name' => Yii::$app->params['main-team']])->one();
//        var_dump($this);
//        $this->params['teamId'] = $data['mainTeam']->id;
        $data['allPlayers'] = Players::find()
            ->where(['teams_id' => $data['mainTeam']->id])
            ->andWhere(['>', 'date', strtotime(date("01.m.Y 00:00:00"))])
            ->andWhere(['<', 'date', strtotime(date("t.m.Y 23:59:59"))])
            ->orderBy('date')
            ->all();
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

        $data['questions'] = Questions::find()->where(['status' => 'on'])->orderBy('id DESC')->one();
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
            ->andWhere(['<', 'date', time()])
            ->orderBy('date DESC')
            ->limit(3)
            ->all();
        $data['gamesFirst'] = Games::find()
            ->where(['home_id' => $data['mainTeam']->id])
            ->orWhere(['guest_id' => $data['mainTeam']->id])
            ->andWhere(['>', 'date', time()])
            ->orderBy('date')
            ->limit(3)
            ->all();
//var_dump($data['gamesFirst']);
//        var_dump($data['questions']->answers->answer);
//        var_dump($data['questions']->answers->how_many);

//        var_dump($dataProvider['standings']->getModels());

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

    public function actionVote ()
    {
        var_dump($_POST);
    }
}
