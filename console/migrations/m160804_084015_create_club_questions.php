<?php

use yii\db\Migration;

/**
 * Handles the creation for table `club_question_table`.
 */
class m160804_084015_create_club_questions extends Migration
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

        $this->createTable('club_questions', [
            'id' => $this->primaryKey(),
            'name' => $this->string('100')->notNull(),
            'question' => $this->text()->notNull(),
            'answer' => $this->text()->notNull(),
            'email' => $this->string()->notNull(),
            'user_id' => $this->integer()->defaultValue(0),
            'ip' => $this->string('50')->notNull(),
            'status' => 'ENUM("on","off") NOT NULL',
            'date' => $this->integer('11')->notNull(),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('club_question_table');
    }
}
