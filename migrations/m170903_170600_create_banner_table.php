<?php

use yii\db\Migration;

/**
 * Handles the creation of table `banner`.
 */
class m170903_170600_create_banner_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('banner', [
            'id' => $this->primaryKey(),
            'link' => $this->string(255)->notNull(),
            'image' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('banner');
    }
}
