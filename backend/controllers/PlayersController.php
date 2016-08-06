<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use common\models\Players;
use common\models\PlayersSearch;
use common\models\Teams;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlayersController implements the CRUD actions for Players model.
 */
class PlayersController extends Controller
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
     * Lists all Players models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlayersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Players model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Players();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(!empty($_FILES['UploadForm']['tmp_name']['file'])) {
                $model->attachImage($_FILES['UploadForm']['tmp_name']['file'],false);
                if($model->errors) {
                    var_dump($model->errors);
                    die;
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'teams' => Teams::find()->all()
            ]);
        }
    }

    /**
     * Updates an existing Players model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        var_dump($model); die;
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
            return $this->render('update', [
                'model' => $model,
                'teams' => Teams::find()->all()
            ]);
        }
    }

    /**
     * Deletes an existing Players model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionRemoveImage($id)
    {
        $model = $this->findModel($id);
        $image = $model->getImage();
        $model->removeImage($image) ;

        return $this->redirect(['update','id'=>$model->id]);
    }

    public function actionSetMain($id,$id_img)
    {
        $model = $this->findModel($id);
        foreach ($model->getImages() as $img) {
            if ($img->id == $id_img) {
                $model->setMainImage($img);
            }
        }

        return $this->redirect(['update','id'=>$model->id]);
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
