<?php

use yii\db\Migration;

class m160909_084751_update_pages extends Migration
{
    public function up()
    {
        $this->alterColumn('pages', 'content', 'LONGTEXT');

    }

    public function down()
    {
        $this->alterColumn('pages', 'content',$this->text()->notNull());
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
