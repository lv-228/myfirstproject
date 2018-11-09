<?php

use yii\db\Migration;

class m171021_035457_add_fk_player_with_hero_SETNULL extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey("fk_hero_id","player","hero_id","hero","id","SET NULL");
    }

    public function safeDown()
    {
        $this->dropForeignKey("fk_hero_id","player");

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171021_035457_add_fk_player_with_hero_SETNULL cannot be reverted.\n";

        return false;
    }
    */
}
