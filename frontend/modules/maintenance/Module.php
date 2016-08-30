<?php

namespace app\modules\maintenance;

//use common\models\Siteoptions;
use Yii;

/**
 * maintenance module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\maintenance\controllers';

    public $enabled = false;
    public $route = 'maintenance/index';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (Yii::$app->params['disableSite']) {
            $this->enabled = true;
        } else {
            $this->enabled = false;
        }
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 30) {
            return false;
        }

        if ($this->enabled) {
            if ($this->route === 'maintenance/index') {
                Yii::$app->controllerMap['maintenance'] = $this->controllerNamespace . '\DefaultController';
            }
            Yii::$app->catchAll = [$this->route];
        }
    }
}
