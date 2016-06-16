<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_games`.
 */
class m160615_224557_create_category_games extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('category_games', [
            'id' => $this->primaryKey(),
            'name' => $this->string('200')->notNull(),
            'slug' => $this->string('250')->notNull(),
            'status' => 'ENUM("on","off") NOT NULL',
        ],$tableOptions);

        $this->addColumn('games','category_id',$this->integer('11'));

        $this->addForeignKey('games_fk4','games','category_id','category_games','id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('games_fk4','games');
        $this->dropColumn('games','category_id');
        $this->dropTable('category_games');
    }
}
