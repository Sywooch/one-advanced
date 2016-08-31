<?php

use yii\db\Migration;

class m160831_082153_update_players extends Migration
{
    public function up()
    {
        $this->addColumn('players', 'games', $this->integer()->notNull());
        $this->addColumn('players', 'times', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('players', 'times');
        $this->dropColumn('players', 'games');
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
