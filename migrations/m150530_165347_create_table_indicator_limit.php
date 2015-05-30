<?php

use yii\db\Schema;
use yii\db\Migration;

class m150530_165347_create_table_indicator_limit extends Migration
{
    public function up()
    {
        $this->createTable('indicator_limit', [
            'id'           => Schema::TYPE_PK,
            'indicator_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date'         => Schema::TYPE_DATE,
            'value'        => Schema::TYPE_INTEGER . ' NOT NULL',
            'type'         => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);

        $this->addForeignKey('FK_indicator_limit_indicator_value', 'indicator_limit', 'indicator_id', 'indicators', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_indicator_limit_indicator_value', 'indicator_limit');
        $this->dropTable('indicator_limit');
    }
}
