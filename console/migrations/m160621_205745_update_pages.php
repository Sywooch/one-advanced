<?php

use yii\db\Migration;

class m160621_205745_update_pages extends Migration
{
    public function up()
    {
        $this->addColumn('pages', 'widget_bar', $this->text()->after('content'));
    }

    public function down()
    {
        $this->dropColumn('pages', 'widget_bar');
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
