<?php

namespace frontend\widgets;


use common\models\SeasonDetails;
use Yii;
use common\models\Teams;
use yii\data\ActiveDataProvider;

class StandingsWidget extends \yii\bootstrap\Widget
{
    public $template;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $data['mainTeam'] = Teams::find()->where(['name' => Yii::$app->params['main-team']])->one();
        $data['seasonDetails'] = $data['mainTeam']->lastSeasonDetails;
        $data['season'] = $data['seasonDetails']->season;
        $dataProvider['standings'] = new ActiveDataProvider([
            'query' => SeasonDetails::find()
                ->where(['season_id' => $data['season']->id])
                ->orderBy('spectacles DESC')
                ->limit(20),
            'pagination' => false,
        ]);
        return $this->render($this->template,['data' => $data, 'dataProvider' => $dataProvider]);
    }
}