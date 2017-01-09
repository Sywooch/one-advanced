<?php

use yii\db\Migration;

class m170109_153837_update_gallery extends Migration
{
    public function up()
    {
        $this->addColumn('gallery', 'source', $this->text()->notNull());
    }

    public function down()
    {
        $this->dropColumn('gallery', 'source');
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
