<?php

use yii\db\Schema;
use yii\db\Migration;

class m160218_194855_add_categoryes extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string('200')->notNull(),
            'slug' => $this->string('250')->notNull(),
            'status_id' => 'ENUM("on","off") NOT NULL',
        ],$tableOptions);

    }

    public function down()
    {
        $this->dropTable('category');

//        echo "m160218_194855_add_categoryes cannot be reverted.\n";

//        return false;
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
