<?php

use yii\db\Migration;

/**
 * Handles the creation of table `strongModerator`.
 */
class m170903_173620_create_strongModerator_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('strongModerator', [
             'id' => $this->primaryKey(),
            'login' => $this->string(20)->unique()->notNull(),
            'password' => $this->string(20)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('strongModerator');
    }
}
