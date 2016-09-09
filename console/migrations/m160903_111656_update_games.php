<?php

use yii\db\Migration;

class m160903_111656_update_games extends Migration
{
    public function up()
    {
        $this->addColumn('games', 'press_conference2', $this->text()->notNull());

    }

    public function down()
    {
        $this->dropColumn('games', 'press_conference2');

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
