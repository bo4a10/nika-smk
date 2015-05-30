<?php

use yii\db\Schema;
use yii\db\Migration;

class m150530_183151_create_table_current_fc_indicators extends Migration
{
    public function up()
    {
        $this->createTable('indicator_current', [
            'id'           => Schema::TYPE_PK,
            'indicator_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date'         => Schema::TYPE_DATE,
            'value'        => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

        $this->addForeignKey('FK_indicator_current_indicator_value', 'indicator_current', 'indicator_id', 'indicators', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_indicator_current_indicator_value', 'indicator_current');
        $this->dropTable('indicator_current');
    }
}
