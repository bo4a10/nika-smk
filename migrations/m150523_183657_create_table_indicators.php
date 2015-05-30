<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_183657_create_table_indicators extends Migration
{
    public function up()
    {
        $this->createTable('indicators', [
            'id'              => Schema::TYPE_PK,
            'indicator_name'  => Schema::TYPE_STRING . '(255) NOT NULL',
            'measure_unit_id' => Schema::TYPE_INTEGER
        ]);

        $this->addForeignKey('FK_indicator_measure_unit', 'indicators', 'measure_unit_id', 'measure_unit', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_indicator_measure_unit', 'measure_unit');
        $this->dropTable('indicators');
    }
}
