<?php

use yii\db\Migration;

class m171023_163156_delete_fk_smoderId_Translation extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey("fk_smoder_id","translation");
    }

    public function safeDown()
    {
        echo "m171023_163156_delete_fk_smoderId_Translation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171023_163156_delete_fk_smoderId_Translation cannot be reverted.\n";

        return false;
    }
    */
}
