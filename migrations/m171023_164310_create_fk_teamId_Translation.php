<?php

use yii\db\Migration;

class m171023_164310_create_fk_teamId_Translation extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_team_id","translation","team_a_id","team","id","SET NULL");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_team_id","translation");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171023_164310_create_fk_teamId_Translation cannot be reverted.\n";

        return false;
    }
    */
}
