<?php

use yii\db\Migration;

class m170521_084618_update_season_details extends Migration
{
    public function up()
    {

        $this->addColumn('season_details', 'sort', $this->integer(11)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('season_details', 'sort');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
