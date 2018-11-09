<?php

use yii\db\Migration;

/**
 * Handles the creation of table `duration`.
 */
class m170903_171328_create_duration_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('duration', [
            'id' => $this->primaryKey(),
            'start_date' => $this->string(10),
            'end_date' => $this->string(10),
            'clicks_numbers' => $this->integer(5),
            'show_numbers' => $this->integer(5),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('duration');
    }
}
