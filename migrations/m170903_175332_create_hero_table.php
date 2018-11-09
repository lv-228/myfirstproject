<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hero`.
 */
class m170903_175332_create_hero_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
         $this->createTable('hero', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->unique()->notNull(),
            'kda' => $this->string(10)->notNull(),
            'icon' => $this->string(255)->unique()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('hero');
    }
}
