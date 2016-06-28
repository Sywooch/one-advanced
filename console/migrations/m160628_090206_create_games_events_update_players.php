<?php

use yii\db\Migration;

/**
 * Handles the creation for table `games_events`.
 */
class m160628_090206_create_games_events_update_players extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('games_events', [
            'id' => $this->primaryKey(),
            'game_id' => $this->integer()->notNull(),
            'team_id' => $this->integer()->notNull(),
            'event_type' => 'ENUM("goal","y_card","r_card","replacement") NOT NULL',
            'player_one_id' => $this->integer()->notNull(),
            'player_two_id' => $this->integer()->notNull(),
            'time' => $this->integer()->notNull(),
        ]);

        $this->alterColumn('players', 'role', 'ENUM("вр","зщ","пз","нп")');

        $this->addForeignKey('games_events_ibfk_1','games_events','game_id','games','id','CASCADE','CASCADE');
        $this->addForeignKey('games_events_ibfk_2','games_events','team_id','teams','id','CASCADE','CASCADE');
        $this->addForeignKey('games_events_ibfk_3','games_events','player_one_id','players','id','CASCADE','CASCADE');
        $this->addForeignKey('games_events_ibfk_4','games_events','player_two_id','players','id','CASCADE','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('games_events_ibfk_4','games_events');
        $this->dropForeignKey('games_events_ibfk_3','games_events');
        $this->dropForeignKey('games_events_ibfk_2','games_events');
        $this->dropForeignKey('games_events_ibfk_1','games_events');

        $this->alterColumn('players', 'role', $this->integer('11')->defaultValue('0'));

        $this->dropTable('games_events');
    }
}
