<?php

use yii\db\Migration;

class m160829_213220_create_slider_update_games extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('slider', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'link' => $this->string('100')->notNull(),
            'sort' => $this->integer()->defaultValue(0),
            'status' => 'ENUM("on","off") NOT NULL',
        ],$tableOptions);

        $this->addColumn('games', 'preview_content', $this->text()->notNull());
        $this->addColumn('games', 'statistics', $this->text()->notNull());
        $this->addColumn('games', 'press_conference', $this->text()->notNull());
        $this->addColumn('players', 'career', $this->text()->notNull());

    }

    public function down()
    {
        $this->dropTable('slider');
        $this->dropColumn('games', 'preview_content');
        $this->dropColumn('games', 'statistics');
        $this->dropColumn('games', 'press_conference');
        $this->dropColumn('players', 'career');

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
