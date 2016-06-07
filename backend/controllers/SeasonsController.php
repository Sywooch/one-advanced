<?php

namespace backend\controllers;

use common\models\SeasonDetails;
use common\models\Teams;
use common\models\TeamsSearch;
use common\models\User;
use Yii;
use common\models\Seasons;
use common\models\SeasonsSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SeasonsController implements the CRUD actions for Seasons model.
 */
class SeasonsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Seasons models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeasonsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Seasons model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Seasons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Seasons();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Seasons model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
//        var_dump($_POST);
//        die;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $searchModel['teams'] = new TeamsSearch();
            $dataProvider['teams'] = $searchModel['teams']->search(Yii::$app->request->queryParams);

            $dataProvider['seasonTeams'] = new ActiveDataProvider(['query' => SeasonDetails::find()]);

            return $this->render('update', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        }
    }

    public function actionAdd()
    {
        $data = Yii::$app->request->post('data');
        $teams =ArrayHelper::getColumn(
            SeasonDetails::find()
                ->select('team_id')
                ->where(['season_id' => $data['season']])
                ->asArray()
                ->all(),
            'team_id'
        );
        foreach ($data['array'] as $team) {
            if (!in_array($team, $teams)) {
                $model = new SeasonDetails();
                $model->season_id = $data['season'];
                $model->team_id = $team;
                $model->games = 0;
                $model->wins = 0;
                $model->draws = 0;
                $model->lesions = 0;
                $model->spectacles = 0;
                $model->goals_against = 0;
                $model->goals_scored = 0;
                $model->save();
            }
        }
    }

    /**
     * Deletes an existing Seasons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Seasons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seasons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seasons::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
