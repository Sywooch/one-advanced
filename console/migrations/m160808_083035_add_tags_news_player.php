<?php

use yii\db\Migration;

class m160808_083035_add_tags_news_player extends Migration
{
    public function up()
    {
        $this->addColumn('players', 'tag', $this->string()->notNull());
        $this->addColumn('news', 'tags', $this->text()->notNull());
        $this->addColumn('games', 'translation', $this->text()->notNull());
        $this->addColumn('games', 'video_id', $this->string()->notNull());
        $this->addColumn('games', 'behavior_rules', $this->text()->notNull());
        $this->addColumn('games', 'ticket_id', $this->string()->notNull());
        $this->addColumn('games', 'prizes', $this->text()->notNull());
        $this->addColumn('games', 'recaps', $this->text()->notNull());
        $this->alterColumn('seasons', 'full_name',$this->text()->notNull());
        $this->addColumn('coaching_staff', 'content', $this->text()->notNull());
        $this->addColumn('coaching_staff', 'category', 'ENUM("admin","trainer") NOT NULL');
    }

    public function down()
    {
//        $this->dropColumn('coaching_staff', 'category');
//        $this->dropColumn('coaching_staff', 'content');
        $this->alterColumn('seasons', 'full_name',$this->string(200)->notNull());
        $this->dropColumn('games', 'recaps');
        $this->dropColumn('games', 'prizes');
        $this->dropColumn('games', 'ticket_id');
        $this->dropColumn('games', 'behavior_rules');
        $this->dropColumn('games', 'video_id');
        $this->dropColumn('games', 'translation');
        $this->dropColumn('news', 'tags');
        $this->dropColumn('players', 'tag');
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
