<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m170903_171859_create_message_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'content' => $this->string()->notNull(),
            'type' => $this->integer(1),
            'date_time' => $this->string(17)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('message');
    }
}
