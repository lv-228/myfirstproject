<?php

use yii\db\Migration;

class m171024_044206_create_fk_transId_Message extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_trans_id","message","trans_id","translation","id","CASCADE");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_trans_id","message");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171024_044206_create_fk_transId_Message cannot be reverted.\n";

        return false;
    }
    */
}
