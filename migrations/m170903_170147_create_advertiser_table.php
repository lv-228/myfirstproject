<?php

use yii\db\Migration;

/**
 * Handles the creation of table `advertiser`.
 */
class m170903_170147_create_advertiser_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('advertiser', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
            'other' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('advertiser');
    }
}
