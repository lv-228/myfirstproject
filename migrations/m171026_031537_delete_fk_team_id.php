<?php

use yii\db\Migration;

class m171026_031537_delete_fk_team_id extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey("fk_team_id","translation");
    }

    public function safeDown()
    {
        echo "m171026_031537_delete_fk_team_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171026_031537_delete_fk_team_id cannot be reverted.\n";

        return false;
    }
    */
}
