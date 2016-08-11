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
use yii\helpers\Json;
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
            if(!empty($_FILES['UploadForm']['tmp_name']['file'])) {
                $model->removeImages();
                $model->attachImage($_FILES['UploadForm']['tmp_name']['file']);
                if($model->errors) {
                    var_dump($model->errors);
                    die;
                }
            }
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
            if(!empty($_FILES['UploadForm']['tmp_name']['file'])) {
                $model->removeImages();
                $model->attachImage($_FILES['UploadForm']['tmp_name']['file']);
                if($model->errors) {
                    var_dump($model->errors);
                    die;
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $searchModel['teams'] = new TeamsSearch();
            $dataProvider['teams'] = $searchModel['teams']->search(Yii::$app->request->queryParams);

            $dataProvider['seasonTeams'] = new ActiveDataProvider(['query' => SeasonDetails::find()->where(['season_id' => $id])]);

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

    public function actionTeams() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id = $parents[0];
                $model = $this->findModel($id);
                foreach ($model->seasonDetails as $seasonDetails) {
                    $out[] = ['id'=>$seasonDetails->team->id, 'name' => $seasonDetails->team->name];
                }
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    // THE CONTROLLER
//    public function actionSubcat() {
//        $out = [];
//        if (isset($_POST['depdrop_parents'])) {
//            $parents = $_POST['depdrop_parents'];
//            if ($parents != null) {
//                $cat_id = $parents[0];
//                $out = self::getSubCatList($cat_id);
//                // the getSubCatList function will query the database based on the
//                // cat_id and return an array like below:
//                // [
//                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
//                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
//                // ]
//                echo Json::encode(['output'=>$out, 'selected'=>'']);
//                return;
//            }
//        }
//        echo Json::encode(['output'=>'', 'selected'=>'']);
//    }

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
