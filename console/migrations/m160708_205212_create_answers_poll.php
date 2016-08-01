<?php

use yii\db\Migration;

/**
 * Handles the creation for table `answers_poll`.
 */
class m160708_205212_create_answers_poll extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('answers_poll', [
            'id' => $this->primaryKey(),
            'quest_id' => $this->integer(),
            'answer_id' => $this->integer(),
            'ip' => $this->string(),
            'date' => $this->integer(),
        ]);

        $this->addForeignKey('answers_poll_ibfk_1','answers_poll','quest_id','questions','id','CASCADE','CASCADE');
        $this->addForeignKey('answers_poll_ibfk_2','answers_poll','answer_id','answers','id','CASCADE','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('answers_poll_ibfk_1','answers_poll');
        $this->dropForeignKey('answers_poll_ibfk_2','answers_poll');

        $this->dropTable('answers_poll');
    }
}
