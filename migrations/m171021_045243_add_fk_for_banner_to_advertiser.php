<?php

use yii\db\Migration;

class m171021_045243_add_fk_for_banner_to_advertiser extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_adver_id","banner","advertiser_id","advertiser","id","CASCADE");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_adver_id","banner");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171021_045243_add_fk_for_banner_to_advertiser cannot be reverted.\n";

        return false;
    }
    */
}
