<?php

use yii\db\Migration;

class m160624_083518_insert_category_games extends Migration
{
    public function up()
    {
        $this->insert('category_games', [
            'name' => 'Первенство',
            'slug' => 'championship',
            'status' => 'on',
        ]);
        $this->insert('category_games', [
            'name' => 'Кубок',
            'slug' => 'cup',
            'status' => 'on',
        ]);
        $this->insert('category_games', [
            'name' => 'Товарищеский',
            'slug' => 'frendly',
            'status' => 'on',
        ]);
    }

    public function down()
    {
        $this->delete('category_games', ['name' => 'Первенство', 'slug' => 'championship']);
        $this->delete('category_games', ['name' => 'Кубок', 'slug' => 'cup']);
        $this->delete('category_games', ['name' => 'Товарищеский', 'slug' => 'frendly']);
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
