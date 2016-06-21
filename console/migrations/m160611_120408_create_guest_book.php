<?php

use yii\db\Migration;

/**
 * Handles the creation for table `guest_book`.
 */
class m160611_120408_create_guest_book extends Migration
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

        $this->createTable('guest_book', [
            'id' => $this->primaryKey(),
            'name' => $this->string('100')->notNull(),
            'body' => $this->text()->notNull(),
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
        $this->dropTable('guest_book');

    }
}
