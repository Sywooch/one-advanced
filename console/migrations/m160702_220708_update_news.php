<?php

use yii\db\Migration;

class m160702_220708_update_news extends Migration
{
    public function up()
    {
        $this->addColumn('news', 'date_create', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('news', 'date_create');
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
