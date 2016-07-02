<?php

namespace frontend\controllers;

use common\models\GamesPlayers;
use common\models\GamesPlayersSearch;
use common\models\Players;
use common\models\PlayersSearch;
use common\models\Teams;
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
        ];
    }

    /**
     * Lists all Games models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GamesSearch();
        $dataProvider = $searchModel->searchFrontend(Yii::$app->request->queryParams);

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
        $model = $this->findModel($id);
        $gameData['home'] = GamesPlayers::find()
            ->where(['game_id' => $model->id, 'team_id' => $model->home_id])
            ->all();
        $gameData['guest'] = GamesPlayers::find()
            ->where(['game_id' => $model->id, 'team_id' => $model->guest_id])
            ->all();
        $gameData['mainTeam'] = Teams::find()->select('id')->where(['name' => Yii::$app->params['main-team']])->one();


        $gameData['nextGame'] = Games::find()
            ->select('id')
            ->where(['home_id' => $gameData['mainTeam']->id])
            ->orWhere(['guest_id' => $gameData['mainTeam']->id])
            ->andWhere(['>', 'date', $model->date])
            ->one();
        $gameData['prevGame'] = Games::find()
            ->select('id')
            ->where(['home_id' => $gameData['mainTeam']->id])
            ->orWhere(['guest_id' => $gameData['mainTeam']->id])
            ->andWhere(['<', 'date', $model->date])
            ->orderBy('date DESC')
            ->one();

        $dataProvider['gamePlayersHome'] = new ActiveDataProvider([
            'query' => GamesPlayers::find()
                ->where(['game_id' => $model->id, 'team_id' => $model->home_id]),
        ]);

        $dataProvider['gamePlayersGuest'] = new ActiveDataProvider([
            'query' => GamesPlayers::find()
                ->where(['game_id' => $model->id, 'team_id' => $model->guest_id]),
        ]);

        return $this->render('view', [
            'model' => $model,
            'gameData' => $gameData,
            'dataProvider' => $dataProvider,
        ]);
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
