<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_185000_create_table_football_clubs extends Migration
{
    public function up()
    {
        $this->createTable('football_club', [
            'id'              => Schema::TYPE_PK,
            'fc_name'         => Schema::TYPE_STRING . '(255) NOT NULL',
            'city_id'         => Schema::TYPE_INTEGER,
            'stadium_id'      => Schema::TYPE_INTEGER
        ]);

        $this->addForeignKey('FK_fc_city', 'football_club', 'city_id', 'city', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_fc_stadium', 'football_club', 'stadium_id', 'stadium', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_fc_city', 'stadium');
        $this->dropForeignKey('FK_fc_stadium', 'stadium');
        $this->dropTable('football_club');
    }
}
