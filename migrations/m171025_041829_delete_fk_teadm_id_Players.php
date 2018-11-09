<?php

use yii\db\Migration;

class m171025_041829_delete_fk_teadm_id_Players extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey("fk_teadm_id","player");
    }

    public function safeDown()
    {
        echo "m171025_041829_delete_fk_teadm_id_Players cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171025_041829_delete_fk_teadm_id_Players cannot be reverted.\n";

        return false;
    }
    */
}
