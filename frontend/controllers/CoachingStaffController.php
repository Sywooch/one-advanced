<?php

namespace frontend\controllers;

use common\models\CategoryCaches;
use common\models\User;
use Yii;
use common\models\CoachingStaff;
use common\models\CoachingStaffSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CoachingStaffController implements the CRUD actions for CoachingStaff model.
 */
class CoachingStaffController extends Controller
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
     * Lists all CoachingStaff models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new CoachingStaffSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionAdministrations()
    {
        $categoryArr = ArrayHelper::getColumn(CoachingStaff::find()->select('category_caches')->distinct()->where(['status' => 'on', 'category' => 'admin'])->asArray()->all(), 'category_caches');

        $data['allCategory'] = CategoryCaches::find()->where(['status' => 'on'])->andWhere(['in', 'id', $categoryArr])->asArray()->all();
        $data['allCategory'] = ArrayHelper::map($data['allCategory'], 'id', 'name');

        $dataProvider = [];
        foreach($categoryArr as $item) {
            $dataProvider[$item] = new ActiveDataProvider([
                'query' => CoachingStaff::find()->where(['category' => 'admin'])->andWhere(['category_caches' => $item])->orderBy('sort ASC, id ASC'),
            ]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'data' => $data,
            'title' => 'Административный состав'
        ]);
    }

    public function actionCoaches()
    {
        $categoryArr = ArrayHelper::getColumn(CoachingStaff::find()->select('category_caches')->distinct()->where(['status' => 'on', 'category' => 'trainer'])->asArray()->all(), 'category_caches');

        $data['allCategory'] = CategoryCaches::find()->where(['status' => 'on'])->andWhere(['in', 'id', $categoryArr])->asArray()->all();
        $data['allCategory'] = ArrayHelper::map($data['allCategory'], 'id', 'name');

        $dataProvider = [];
        foreach($categoryArr as $item) {
            $dataProvider[$item] = new ActiveDataProvider([
                'query' => CoachingStaff::find()->where(['category' => 'trainer'])->andWhere(['category_caches' => $item])->orderBy('sort ASC, id ASC'),
            ]);
        }
//        $dataProvider = new ActiveDataProvider([
//            'query' => CoachingStaff::find()->where(['category' => 'trainer']),
//        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'data' => $data,
            'title' => 'Тренерский штаб'
        ]);
    }

    /**
     * Displays a single CoachingStaff model.
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
     * Finds the CoachingStaff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CoachingStaff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CoachingStaff::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
