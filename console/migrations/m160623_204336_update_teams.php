<?php

use yii\db\Migration;

class m160623_204336_update_teams extends Migration
{
    public function up()
    {
        $this->addColumn('teams', 'city', $this->string('255')->notNull());
        $this->addColumn('teams', 'stadium', $this->string('255')->notNull());
    }

    public function down()
    {
        $this->dropColumn('teams', 'city');
        $this->dropColumn('teams', 'stadium');
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
