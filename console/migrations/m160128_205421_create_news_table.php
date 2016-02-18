<?php

use yii\db\Schema;
use yii\db\Migration;

class m160128_205421_create_news_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string('100')->notNull(),
            'alias' => $this->string('100')->notNull(),
            'category_id' => $this->smallInteger('6')->defaultValue('0'),
            'snippet' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
//            'image_url' => $this->string('64')->notNull(),
            'views' => $this->integer('11')->defaultValue('0'),
            'comments' => $this->integer('11')->defaultValue('0'),
            'status_id' => 'ENUM("on","off") NOT NULL',
            'date' => $this->integer('11')->notNull(),
        ],$tableOptions);

    }

    public function down()
    {
        $this->dropTable('news');
//        echo "m160128_205421_create_news_table cannot be reverted.\n";
//
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
