<?php

use yii\db\Migration;

class m160227_230902_create_seasons extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('seasons', [
            'id' => $this->primaryKey(),
            'name' => $this->string('200')->notNull(),
            'full_name' => $this->string('200')->notNull(),
            'division' => $this->string('200')->notNull(),
            'slug' => $this->string('250')->notNull(),
            'status' => 'ENUM("on","off") NOT NULL',

        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('seasons');
    }
}
