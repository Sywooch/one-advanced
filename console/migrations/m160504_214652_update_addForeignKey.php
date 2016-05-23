<?php

use yii\db\Migration;

class m160504_214652_update_addForeignKey extends Migration
{
    public function up()
    {
        $this->alterColumn('news','category_id',$this->integer('11')->notNull());
        $this->addForeignKey('news_ibfk_1','news','category_id','category','id','CASCADE','CASCADE');
        $this->addForeignKey('players_ibfk_1','players','teams_id','teams','id','CASCADE','CASCADE');
        $this->addForeignKey('menu_ibfk_1','menu','parent_id','menu','id','CASCADE','CASCADE');
        $this->addForeignKey('games_ibfk_1','games','home_id','teams','id','CASCADE','CASCADE');
        $this->addForeignKey('games_ibfk_2','games','guest_id','teams','id','CASCADE','CASCADE');
        $this->addForeignKey('games_ibfk_3','games','season_id','seasons','id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('news_ibfk_1','news');
        $this->dropForeignKey('players_ibfk_1','players');
        $this->dropForeignKey('menu_ibfk_1','menu');
        $this->dropForeignKey('games_ibfk_1','games');
        $this->dropForeignKey('games_ibfk_2','games');
        $this->dropForeignKey('games_ibfk_3','games');
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
