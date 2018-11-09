<?php

use yii\db\Migration;

class m171019_145545_altcolumn_message_type_for_string60 extends Migration
{
    public function safeUp()
    {
        $this->alterColumn("message","type","string(60)");
    }

    public function safeDown()
    {
        echo "m171019_145545_altcolumn_message_type_for_string60 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171019_145545_altcolumn_message_type_for_string60 cannot be reverted.\n";

        return false;
    }
    */
}
