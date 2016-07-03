<?php

use yii\db\Migration;

/**
 * Handles the creation for table `questions`.
 */
class m160627_080337_create_questions_answer extends Migration
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

        $this->createTable('questions', [
            'id' => $this->primaryKey(),
            'questions' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'status' => 'ENUM("on","off") NOT NULL',
        ],$tableOptions);

        $this->createTable('answers', [
            'id' => $this->primaryKey(),
            'questions_id' => $this->integer()->notNull(),
            'answer' => $this->string()->notNull(),
            'how_many' => $this->integer()->notNull()->defaultValue(0),
        ],$tableOptions);

        $this->addForeignKey('answers_ibfk_1','answers','questions_id','questions','id','CASCADE','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('news_ibfk_1','news');

        $this->dropTable('questions');
        $this->dropTable('answers');
    }
}
