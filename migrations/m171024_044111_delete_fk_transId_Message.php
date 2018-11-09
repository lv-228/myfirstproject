<?php

use yii\db\Migration;

class m171024_044111_delete_fk_transId_Message extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey("fk_trans_id","message");
    }

    public function safeDown()
    {
        echo "m171024_044111_delete_fk_transId_Message cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171024_044111_delete_fk_transId_Message cannot be reverted.\n";

        return false;
    }
    */
}
