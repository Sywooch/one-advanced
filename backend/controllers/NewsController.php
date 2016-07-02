<?php

namespace backend\controllers;

use common\models\User;
use rico\yii2images\models\Image;
use Yii;
use common\models\News;
use common\models\NewsSearch;
use common\models\Category;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
//        var_dump($model->getImage());
//        $images = $model->getImage();
//        if(isset($_GET['newmainimg'])) {
//            foreach ($model->getImages() as $img) {
//                if ($img->id == $_GET['newmainimg']) {
//                    $model->setMainImage($img);//will set current image main
//                }
//            }
//        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->date_create = time();
            if(!empty($_FILES['UploadForm']['tmp_name']['file'])) {
                $model->attachImage($_FILES['UploadForm']['tmp_name']['file'],false);
                if($model->errors) {
                    var_dump($model->errors);
                    die;
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
//            $model-> category = Category::find()->all();
//            var_dump($model);die;
            return $this->render('create', [
                'model' => $model,
                'category' => Category::find()->all()
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(!empty($_FILES['UploadForm']['tmp_name']['file'])) {
                $model->attachImage($_FILES['UploadForm']['tmp_name']['file']);
                if($model->errors) {
                    var_dump($model->errors);
                    die;
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
//            if(isset($_GET['newmainimg'])) {
//                foreach ($model->getImages() as $img) {
//                    if ($img->id == $_GET['newmainimg']) {
//                        $model->setMainImage($img);//will set current image main
//                    }
//                }
//            }

            return $this->render('update', [
                'model' => $model,
                'category' => Category::find()->all()
            ]);
        }
    }



    /**
     * Deletes an existing News model.
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
        $model = Image::findOne($id);
        $itemId = $model->itemId;
        if ($model->delete()) {
            return $this->redirect(['update','id' => $itemId]);
        } else {
            return $model->errors;
        }
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
