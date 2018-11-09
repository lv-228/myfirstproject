<?php

use yii\db\Migration;

class m171023_164407_create_fk_smoderId_Translation extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_smoder_id","translation","smoder_id","strongmoderator","id","SET NULL");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_smoder_id","translation");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171023_164407_create_fk_smoderId_Translation cannot be reverted.\n";

        return false;
    }
    */
}
