<?php

use yii\db\Migration;

/**
 * Handles the creation for table `season_details`.
 */
class m160601_075127_create_season_details extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('season_details', [
            'id' => $this->primaryKey(),
            'season_id' => $this->integer(11),
            'team_id' => $this->integer(11),
            'games' => $this->integer(11),
            'wins' => $this->integer(11),
            'draws' => $this->integer(11),
            'lesions' => $this->integer(11),
            'spectacles' => $this->integer(11),
            'goals_against' => $this->integer(11),
            'goals_scored' => $this->integer(11),
        ]);

        $this->addForeignKey('season_details_fk1','season_details','season_id','seasons','id');
        $this->addForeignKey('season_details_fk2','season_details','team_id','teams','id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('season_details');

        $this->dropForeignKey('season_details_fk1','news');
        $this->dropForeignKey('season_details_fk2','players');
    }
}
