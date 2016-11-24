<?php

use yii\db\Migration;

class m161005_192812_create_category_and_update_caches extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('category_caches', [
            'id' => $this->primaryKey(),
            'name' => $this->string('200')->notNull(),
            'slug' => $this->string('250')->notNull(),
            'status' => 'ENUM("on","off") NOT NULL',
        ],$tableOptions);

        $this->addColumn('coaching_staff', 'sort', $this->integer('11')->defaultValue(0));
        $this->addColumn('coaching_staff', 'category_caches', $this->integer('11'));
        $this->addForeignKey('coaching_staff_ibfk_2','coaching_staff','category_caches','category_caches','id','CASCADE','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('coaching_staff_ibfk_2','coaching_staff');
        $this->dropColumn('coaching_staff','category_caches');
        $this->dropColumn('coaching_staff','sort');
        $this->dropTable('category_caches');
    }
}
