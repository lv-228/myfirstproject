<?php

use yii\db\Migration;

/**
 * Handles the creation of table `team`.
 */
class m170903_165413_create_team_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('team', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->unique()->notNull(),
            'logo' => $this->string(255)->unique()->notNull(),
            'win_score' => $this->integer(2)->notNull(),
            'lose_score' => $this->integer(2)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('team');
    }
}
