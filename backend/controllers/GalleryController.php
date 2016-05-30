<?php

namespace backend\controllers;

use common\models\User;
use rico\yii2images\models\Image;
use Yii;
use common\models\Gallery;
use common\models\GallerySearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
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
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
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
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();

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
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Gallery model.
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
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUploadFiles($id)
    {
        $model = $this->findModel($id);
        if (!empty($_FILES['gallery']['tmp_name'])) {
            if ($_FILES['gallery']['type'] == 'image/jpeg' || $_FILES['gallery']['type'] == 'image/png') {
                $model->attachImage($_FILES['gallery']['tmp_name']);
                if($model->errors) {
                    var_dump($model->errors);
                }
                return Json::encode(true);
            } else {
                return Json::encode(true);

//                $fileName = 'gallery';
//                $uploadPath = '../../frontend/web/images/store/Galleries/Gallery'.$id;
//                $file = UploadedFile::getInstanceByName($fileName);
//                var_dump($file);
//                if (file_exists($uploadPath)) {
//                    $newfilename = $model->name . '_' . substr(md5(time().$id), 24, 32).$file->name;
//
//                }

//                $filename = \Yii::$app->request->get('filename', '');
//                $filename = trim($filename, '/');
//                $objId = \Yii::$app->request->get('objId', '');
//                $objModelId = \Yii::$app->request->get('objModelId', '');
//                if (empty($filename) === false) {
//                    $image = new Image;
//                    $image->loadDefaultValues();
//                    $image->setAttributes(['filename' => $filename, 'object_id' => $objId, 'object_model_id' => $objModelId]);
//                    $image->save();
//                }
            }

        }
    }


    public function actionRemoveImage($id)
    {
        $model = Image::find()->where(['id' => $id])->one();
        if($model->delete()) {
            return Json::encode(true);
        } else {
            var_dump($model->errors);
            return Json::encode(false);
        }
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
