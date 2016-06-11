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
        $this->createTable('guest_book', [
            'id' => $this->primaryKey(),
            'name' => $this->string('100')->notNull(),
            'body' => $this->text()->notNull(),
            'email' => $this->string()->notNull(),
            'user_id' => $this->integer()->defaultValue(0),
            'ip' => $this->integer('25')->notNull(),
            'status' => 'ENUM("on","off") NOT NULL',
            'date' => $this->integer('11')->notNull(),
        ]);
        $this->addForeignKey('guest_book_fk1','guest_book','user_id','user','id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('guest_book');

    }
}
