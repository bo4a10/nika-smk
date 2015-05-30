<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_184649_create_table_stadiums extends Migration
{
    public function up()
    {
        $this->createTable('stadium', [
            'id'              => Schema::TYPE_PK,
            'stadium_name'  => Schema::TYPE_STRING . '(255) NOT NULL',
            'city_id' => Schema::TYPE_INTEGER
        ]);

        $this->addForeignKey('FK_stadium_city', 'stadium', 'city_id', 'city', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_stadium_city', 'stadium');
        $this->dropTable('stadium');
    }
}
