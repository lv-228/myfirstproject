<?php

use yii\db\Migration;

class m171023_163252_delete_fk_teamBId_Translation extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey("fk_team_b_id","translation");
    }

    public function safeDown()
    {
        echo "m171023_163252_delete_fk_teamBId_Translation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171023_163252_delete_fk_teamBId_Translation cannot be reverted.\n";

        return false;
    }
    */
}
