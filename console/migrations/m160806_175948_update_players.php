<?php

use yii\db\Migration;

class m160806_175948_update_players extends Migration
{
    public function up()
    {
        $this->addColumn('players', 'content', $this->text()->notNull());
        $this->addColumn('players', 'patronymic', $this->string('100')->notNull());
    }

    public function down()
    {
        $this->dropColumn('players', 'patronymic');
        $this->dropColumn('players', 'content');
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
