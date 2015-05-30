<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_191252_create_table_indicators_values extends Migration
{
    public function up()
    {
        $this->createTable('indicator_value', [
            'id'           => Schema::TYPE_PK,
            'fc_id'        => Schema::TYPE_INTEGER . ' NOT NULL',
            'indicator_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date'         => Schema::TYPE_DATE,
            'value'        => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);

        $this->addForeignKey('FK_indicator_value_fc', 'indicator_value', 'fc_id', 'football_club', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_indicator_indicator_value', 'indicator_value', 'indicator_id', 'indicators', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_indicator_value_fc', 'indicator_value');
        $this->dropForeignKey('FK_indicator_indicator_value', 'indicator_value');
        $this->dropTable('indicator_value');
    }
}
