<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_181700_create_table_city extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('city', [
            'id' => Schema::TYPE_PK,
            'city_name' => Schema::TYPE_STRING . '(255) NOT NULL',
        ]);

        $this->insert('city', ['id' => '', 'city_name' => 'Харьков']);
        $this->insert('city', ['city_name' => 'Донецк']);
        $this->insert('city', ['city_name' => 'Киев']);
        $this->insert('city', ['city_name' => 'Львов']);
        $this->insert('city', ['city_name' => 'Запорожье']);
        $this->insert('city', ['city_name' => 'Ужгород']);
        $this->insert('city', ['city_name' => 'Днепропетровск']);
        $this->insert('city', ['city_name' => 'Одесса']);
        $this->insert('city', ['city_name' => 'Тернополь']);
        $this->insert('city', ['city_name' => 'Суммы']);
    }
    public function safeDown()
    {
            $this->dropTable('city');
    }
}
