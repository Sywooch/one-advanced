<?php

namespace frontend\controllers;

use common\models\Teams;
use Yii;
use common\models\Players;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlayersController implements the CRUD actions for Players model.
 */
class PlayersController extends Controller
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
     * Lists all Players models.
     * @return mixed
     */
    public function actionIndex()
    {
        $teamId = Teams::find()->select('id')->where(['name' => Yii::$app->params['main-team']])->one()->id;
        $dataProvider['vr'] = new ActiveDataProvider([
            'query' => Players::find()->where(['teams_id' => $teamId, 'role' => 'вр']),
            'pagination' => false
        ]);
        $dataProvider['zsh'] = new ActiveDataProvider([
            'query' => Players::find()->where(['teams_id' => $teamId, 'role' => 'зщ']),
            'pagination' => false
        ]);
        $dataProvider['pzsh'] = new ActiveDataProvider([
            'query' => Players::find()->where(['teams_id' => $teamId, 'role' => 'пз']),
            'pagination' => false
        ]);
        $dataProvider['np'] = new ActiveDataProvider([
            'query' => Players::find()->where(['teams_id' => $teamId, 'role' => 'нп']),
            'pagination' => false
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Players model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'main-full';

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Players model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Players the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Players::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
