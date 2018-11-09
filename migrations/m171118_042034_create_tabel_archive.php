<?php

use yii\db\Migration;

class m171118_042034_create_tabel_archive extends Migration
{
    public function safeUp()
    {
        $this->createTable('archive', [
            'id' => $this->primaryKey(),
            'translation_id' => $this->integer(),
            'player_1' => $this->string(255),
            'player_2' => $this->string(255),
            'player_3' => $this->string(255),
            'player_4' => $this->string(255),
            'player_5' => $this->string(255),
            'player_6' => $this->string(255),
            'player_7' => $this->string(255),
            'player_8' => $this->string(255),
            'player_9' => $this->string(255),
            'player_10' => $this->string(255),
            'hero_1' => $this->string(255),
            'hero_2' => $this->string(255),
            'hero_3' => $this->string(255),
            'hero_4' => $this->string(255),
            'hero_5' => $this->string(255),
            'hero_6' => $this->string(255),
            'hero_7' => $this->string(255),
            'hero_8' => $this->string(255),
            'hero_9' => $this->string(255),
            'hero_10' => $this->string(255),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('archive');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171118_042034_create_tabel_archive cannot be reverted.\n";

        return false;
    }
    */
}
