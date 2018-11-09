<?php

use yii\db\Migration;

class m171119_070728_create_fk_translation_id extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_trans_id","archive","translation_id","translation","id","CASCADE");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_trans_id","archive");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171119_070728_create_fk_translation_id cannot be reverted.\n";

        return false;
    }
    */
}
