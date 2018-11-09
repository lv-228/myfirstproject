<?php

use yii\db\Migration;

class m171021_050450_delete_fk_duration_to_banner extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey("fk_banner_id","duration");
    }

    public function safeDown()
    {
        echo "m171021_050450_delete_fk_duration_to_banner cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171021_050450_delete_fk_duration_to_banner cannot be reverted.\n";

        return false;
    }
    */
}
