<?php

use yii\db\Migration;

class m171021_043352_delete_column_kda_for_hero extends Migration
{
    public function safeUp()
    {
        $this->dropColumn("hero","kda");
    }

    public function safeDown()
    {
        $this->addColumn("hero","kda","string(20)");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171021_043352_delete_column_kda_for_hero cannot be reverted.\n";

        return false;
    }
    */
}
