<?php

use yii\db\Migration;

class m171018_133055_add_delete_column_in_translation extends Migration
{
    public function safeUp()
    {
        $this->addColumn("translation","delete","boolean");
    }

    public function safeDown()
    {
        $this->dropColumn("translation","delete");

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171018_133055_add_delete_column_in_translation cannot be reverted.\n";

        return false;
    }
    */
}
