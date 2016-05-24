<?php

use yii\db\Migration;

/**
 * Handles the creation for table `gallery`.
 */
class m160511_204639_create_gallery extends Migration
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

        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull(),
            'description' => $this->string('5000'),
            'status' => 'ENUM("on","off") NOT NULL DEFAULT "on"',

        ],$tableOptions);

        $this->addColumn('news','gallery_id',$this->integer('11'));
        $this->addColumn('games','gallery_id',$this->integer('11'));

        $this->addForeignKey('news_fk1','news','gallery_id','gallery','id');
        $this->addForeignKey('games_fk1','games','gallery_id','gallery','id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('news_fk1','news');
        $this->dropForeignKey('games_fk1','games');

        $this->dropColumn('news','gallery_id');
        $this->dropColumn('games','gallery_id');

        $this->dropTable('gallery');
    }
}
