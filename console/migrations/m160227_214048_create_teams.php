<?php

use yii\db\Migration;

class m160227_214048_create_teams extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('teams', [
            'id' => $this->primaryKey(),
            'name' => $this->string('200')->notNull(),
            'slug' => $this->string('250')->notNull(),
            'year' => $this->string('250')->notNull(),
            'web_site' => $this->string('250')->notNull(),
            'description' => $this->text()->notNull(),
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('teams');
    }
}
