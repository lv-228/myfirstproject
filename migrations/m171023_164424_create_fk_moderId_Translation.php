<?php

use yii\db\Migration;

class m171023_164424_create_fk_moderId_Translation extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_moder_id","translation","moder_id","moderator","id","SET NULL");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_moder_id","translation");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171023_164424_create_fk_moderId_Translation cannot be reverted.\n";

        return false;
    }
    */
}
