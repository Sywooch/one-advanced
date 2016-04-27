<?php

use yii\db\Migration;

class m160415_185412_create_pages extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('pages', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull(),
            'meta_title' => $this->string('255')->notNull(),
            'meta_keywords' => $this->string('255')->notNull(),
            'meta_descr' => $this->string('255')->notNull(),
            'content' => $this->text()->notNull(),
            'slug' => $this->string('125')->notNull(),
            'status' => 'ENUM("on","off") NOT NULL',
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('pages');
    }
}
