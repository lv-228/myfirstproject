<?php

use yii\db\Migration;

class m171025_041858_create_fk_teadmId_Players extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_teadm_id","player","team_id","team","id","SET NULL");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_teadm_id","player");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171025_041858_create_fk_teadmId_Players cannot be reverted.\n";

        return false;
    }
    */
}
