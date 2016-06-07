<?php

namespace backend\controllers;

use common\models\GamesPlayers;
use common\models\GamesPlayersSearch;
use common\models\Players;
use common\models\PlayersSearch;
use Yii;
use common\models\Games;
use common\models\GamesSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;

/**
 * GamesController implements the CRUD actions for Games model.
 */
class GamesController extends Controller
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
     * Lists all Games models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GamesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Games model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//        $query = Players::find()->indexBy('id'); // where `id` is your primary key
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
        $model = $this->findModel($id);
        $gameData['home'] = GamesPlayers::find()
            ->where(['game_id' => $model->id, 'team_id' => $model->home_id])
            ->all();
        $gameData['guest'] = GamesPlayers::find()
            ->where(['game_id' => $model->id, 'team_id' => $model->guest_id])
            ->all();

        return $this->render('view', [
            'model' => $model,
            'gameData' => $gameData,
        ]);
    }

    /**
     * Creates a new Games model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Games();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Games model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            $dataProvider['playersHome'] = new ActiveDataProvider([
                'query' => Players::find()
                    ->where(['teams_id' => $model->home_id]),
            ]);

            $dataProvider['gamePlayersHome'] = new ActiveDataProvider([
                'query' => GamesPlayers::find()
                    ->where(['game_id' => $model->id, 'team_id' => $model->home_id]),
            ]);

            $dataProvider['playersGuest'] = new ActiveDataProvider([
                'query' => Players::find()
                    ->where(['teams_id' => $model->guest_id]),
            ]);

            $dataProvider['gamePlayersGuest'] = new ActiveDataProvider([
                'query' => GamesPlayers::find()
                    ->where(['game_id' => $model->id, 'team_id' => $model->guest_id]),
            ]);

            return $this->render('update', [
                'model' => $model,
//                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]);
        }
    }

    /**
     * Deletes an existing Games model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAdd()
    {
        $data = Yii::$app->request->post('data');
        $players =ArrayHelper::getColumn(
            GamesPlayers::find()
                ->select('player_id')
                ->where(['game_id' => $data['game'], 'team_id' => $data['team']])
                ->asArray()
                ->all(),
            'player_id'
        );
        foreach ($data['array'] as $player) {
            if (!in_array($player, $players)) {
                $model = new GamesPlayers();
                $model->game_id = $data['game'];
                $model->team_id = $data['team'];
                $model->player_id = $player;
                $model->save();
            }
        }
    }

    /**
     * Finds the Games model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Games the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Games::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
