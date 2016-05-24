<?php

use yii\db\Migration;

/**
 * Handles the creation for table `games_players`.
 */
class m160504_211431_create_games_players extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('games_players', [
            'id' => $this->primaryKey(),
            'game_id' => $this->integer('11')->notNull(),
            'team_id' => $this->integer('11')->notNull(),
            'player_id' => $this->integer('11')->notNull(),
            'time' => $this->integer('11')->notNull(),
            'FOREIGN KEY (game_id) REFERENCES games(id)
                ON UPDATE CASCADE
                ON DELETE CASCADE,
            FOREIGN KEY (player_id) REFERENCES players(id)
                ON UPDATE CASCADE
                ON DELETE CASCADE'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('games_players');
    }
}
