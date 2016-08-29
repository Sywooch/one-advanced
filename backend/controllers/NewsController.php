<?php

namespace backend\controllers;

use common\models\User;
use rico\yii2images\models\Image;
use Yii;
use common\models\News;
use common\models\NewsSearch;
use common\models\Category;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
            $model->alias = mb_strtolower(strtr($model->title, Yii::$app->params['transliterate']));
            $model->date_create = Yii::$app->formatter->asTimestamp($model->date_create. ' 12:00');


//            $model->date_create = date(time());
            $model->save();
//            if(!empty($_FILES['UploadForm']['tmp_name']['file'])) {
//                $model->attachImage($_FILES['UploadForm']['tmp_name']['file'],false);
//                if($model->errors) {
//                    var_dump($model->errors);
//                    die;
//                }
//            }
            return $this->redirect(['update', 'id' => $model->id]);
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
        $oldTitle = $model->title;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->title != $oldTitle) {
                $model->alias = mb_strtolower(strtr($model->title, Yii::$app->params['transliterate']));
                $model->save();
            }
            $model->date_create = Yii::$app->formatter->asTimestamp($model->date_create. ' 12:00');
            $model->save();
//            $file = UploadedFile::getInstance($model, 'file');
//            var_dump($file);
//            var_dump($_FILES);die;
//            if(!empty($_FILES['UploadForm']['tmp_name']['file'])) {
//                $model->attachImage($_FILES['UploadForm']['tmp_name']['file']);
//                if($model->errors) {
//                    var_dump($model->errors);
//                    die;
//                }
//            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
                'category' => Category::find()->all()
            ]);
        }
    }

    public function actionUploadFiles($id)
    {
//        var_dump($_FILES);
////        var_dump($_POST);
//        var_dump($_GET);
//        return Json::encode(true);

        $model = $this->findModel($id);
        if (!empty($_FILES['UploadForm']['tmp_name']['file'])) {
            if ($_FILES['UploadForm']['type']['file'] == 'image/jpeg' || $_FILES['UploadForm']['type']['file'] == 'image/png') {
                $model->attachImage($_FILES['UploadForm']['tmp_name']['file']);
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
