<?php

namespace app\modules\maintenance\controllers;

//use common\models\Siteoptions;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `maintenance` module
 */
class DefaultController extends Controller
{
    /**
     * Initialize controller.
     */
    public function init()
    {
        $this->layout = '@app/modules/maintenance/views/layouts/main';
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->getRequest()->getIsAjax()) {
            return false;
        }
        return $this->render('@app/modules/maintenance/views/default/index');
    }
}
