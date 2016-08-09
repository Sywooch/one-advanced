<?php

use yii\db\Migration;

class m160808_083035_add_tags_news_player extends Migration
{
    public function up()
    {
        $this->addColumn('players', 'tag', $this->string()->notNull());
        $this->addColumn('news', 'tags', $this->text()->notNull());
    }

    public function down()
    {
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
