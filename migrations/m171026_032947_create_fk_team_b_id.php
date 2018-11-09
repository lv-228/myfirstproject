<?php

use yii\db\Migration;

class m171026_032947_create_fk_team_b_id extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_team_b_id","translation","team_a_id","team","id");
    }

    public function safeDown()
    {
        echo "m171026_032947_create_fk_team_b_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171026_032947_create_fk_team_b_id cannot be reverted.\n";

        return false;
    }
    */
}
