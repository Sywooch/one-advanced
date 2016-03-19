<?php

use yii\db\Migration;

class m160316_200944_create_players extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('players', [
            'id' => $this->primaryKey(),
            'name' => $this->string('100')->notNull(),
            'surname' => $this->string('100')->notNull(),
            'number' => $this->integer('11')->defaultValue('0'),
            'nationality' => $this->string('100')->notNull(),
            'height' => $this->integer('11')->defaultValue('0'),
            'weight' => $this->integer('11')->defaultValue('0'),
            'date' => $this->integer('11')->notNull(),
            'role' => $this->integer('11')->defaultValue('0'),
            'teams_id' => $this->integer('11')->notNull(),
            'goals' => $this->integer('11')->defaultValue('0'),
            'transfers' => $this->integer('11')->defaultValue('0'),
            'yellow_cards' => $this->integer('11')->defaultValue('0'),
            'red_cards' => $this->integer('11')->defaultValue('0'),
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('players');
    }
}
