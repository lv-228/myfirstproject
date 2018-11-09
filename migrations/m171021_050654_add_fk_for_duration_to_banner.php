<?php

use yii\db\Migration;

class m171021_050654_add_fk_for_duration_to_banner extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_banner_id","duration","banner_id","banner","id","CASCADE");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_banner_id","duration");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171021_050654_add_fk_for_duration_to_banner cannot be reverted.\n";

        return false;
    }
    */
}
