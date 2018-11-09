<?php

use yii\db\Migration;

/**
 * Handles the creation of table `player`.
 */
class m170903_164656_create_player_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('player', [
            'id' => $this->primaryKey(),
            'nick' => $this->string(30)->unique()->notNull(),
            'icon' => $this->string(255)->unique()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('player');
    }
}
