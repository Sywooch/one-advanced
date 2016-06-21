<?php

use yii\db\Migration;

/**
 * Handles the creation for table `black_list`.
 */
class m160614_150842_create_black_list extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('black_list', [
            'id' => $this->primaryKey(),
            'email' => $this->string(),
            'user_id' => $this->integer(),
            'ip' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('black_list');
    }
}
