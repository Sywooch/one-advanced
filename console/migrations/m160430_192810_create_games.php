<?php

use yii\db\Migration;

class m160430_192810_create_games extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('games', [
            'id' => $this->primaryKey(),
            'home_id' => $this->integer('11')->notNull(),
            'guest_id' => $this->integer('11')->notNull(),
            'season_id' => $this->integer('11')->notNull(),
            'tour' => $this->integer('11')->notNull(),
            'score' => $this->string('50')->notNull(),
            'city' => $this->string('255')->notNull(),
            'stadium' => $this->string('255')->notNull(),
            'referee' => $this->string('255')->notNull(),
            'referee2' => $this->string('255')->notNull(),
            'referee3' => $this->string('255')->notNull(),
            'content' => $this->text()->notNull(),
            'date' => $this->integer('11')->notNull(),
            'status' => 'ENUM("будет","был","отменён","перенесён") NOT NULL',
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('games');
    }
}
