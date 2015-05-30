<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_183446_create_table_unit_of_measure extends Migration
{
    public function up()
    {
        $this->createTable('measure_unit', [
            'id' => Schema::TYPE_PK,
            'unit_name' => Schema::TYPE_STRING . '(255) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('measure_unit');
    }
}
