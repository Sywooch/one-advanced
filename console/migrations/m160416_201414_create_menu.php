<?php

use yii\db\Migration;

class m160416_201414_create_menu extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('menu', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer('11')->defaultValue('0'),
            'name' => $this->string('255')->notNull(),
            'url' => $this->string('255')->notNull(),
            'position' => 'ENUM("headerTop","headerBottom") NOT NULL',
            'sort' => $this->integer('11')->defaultValue('0'),
            'status' => 'ENUM("on","off") NOT NULL',
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('menu');
    }
}
