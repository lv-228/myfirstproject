<?php

use yii\db\Migration;

class m171021_044939_delet_fk_banner_to_advertiser extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey("fk_adver_id","banner");
    }

    public function safeDown()
    {
        echo "m171021_044939_delet_fk_banner_to_advertiser cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171021_044939_delet_fk_banner_to_advertiser cannot be reverted.\n";

        return false;
    }
    */
}
