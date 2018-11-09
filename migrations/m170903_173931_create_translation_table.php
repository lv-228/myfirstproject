<?php

use yii\db\Migration;

/**
 * Handles the creation of table `translation`.
 */
class m170903_173931_create_translation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('translation', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->unique()->notNull(),
            'start_date' => $this->string(20)->notNull(),
            'status' => $this->boolean()->notNull(),
            'data_create' => $this->string(20)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('translation');
    }
}
