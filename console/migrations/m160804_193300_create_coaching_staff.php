<?php

use yii\db\Migration;

/**
 * Handles the creation for table `coaching_staff`.
 */
class m160804_193300_create_coaching_staff extends Migration
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
        $this->createTable('coaching_staff', [
            'id' => $this->primaryKey(),
            'name' => $this->string('100')->notNull(),
            'surname' => $this->string('100')->notNull(),
            'patronymic' => $this->string('100')->notNull(),
            'date' => $this->integer('11')->notNull(),
            'role' => $this->string('100')->notNull(),
            'teams_id' => $this->integer('11')->notNull(),
            'status' => 'ENUM("on","off") NOT NULL',
        ],$tableOptions);
        $this->addForeignKey('coaching_staff_ibfk_1','coaching_staff','teams_id','teams','id','CASCADE','CASCADE');
        $this->addColumn('club_questions', 'addressee', $this->string('100')->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('club_questions', 'addressee');
        $this->dropForeignKey('coaching_staff_ibfk_1','coaching_staff');
        $this->dropTable('coaching_staff');
    }
}
