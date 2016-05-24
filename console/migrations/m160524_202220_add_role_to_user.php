<?php

use yii\db\Migration;

/**
 * Handles adding role to table `user`.
 */
class m160524_202220_add_role_to_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'role', $this->integer()->notNull()->defaultValue(20));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'role');
    }
}
