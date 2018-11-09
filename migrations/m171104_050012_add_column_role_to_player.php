<?php

use yii\db\Migration;

class m171104_050012_add_column_role_to_player extends Migration
{
    public function safeUp()
    {
        $this->addColumn('player','player_role','string(100)');
    }

    public function safeDown()
    {
        $this->dropColumn('player','player_roles');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171104_050012_add_column_role_to_player cannot be reverted.\n";

        return false;
    }
    */
}
