<?php

use yii\db\Migration;

/**
 * Handles the creation of table `moderator`.
 */
class m170903_173206_create_moderator_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('moderator', [
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
        $this->dropTable('moderator');
    }
}
