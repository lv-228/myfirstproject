<?php

use yii\db\Migration;

class m171023_164340_create_fk_teamBId_Translation extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_team_b_id","translation","team_b_id","team","id","SET NULL");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_team_b_id","translation");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171023_164340_create_fk_teamBId_Translation cannot be reverted.\n";

        return false;
    }
    */
}
