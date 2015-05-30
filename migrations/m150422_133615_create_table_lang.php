<?php

use yii\db\Migration;
use yii\db\Schema;

class m150422_133615_create_table_lang extends Migration
{
	public function up()
	{
		$this->createTable('lang', [
			'id'         => Schema::TYPE_PK,
			'url'        => Schema::TYPE_STRING . ' NOT NULL',
			'local'      => Schema::TYPE_STRING . ' NOT NULL',
			'name'       => Schema::TYPE_STRING . ' NOT NULL',
			'default'    => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
			'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
			'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
		]);

		$this->createIndex('idx_lang_url', 'lang', 'url');
		$this->createIndex('idx_lang_default', 'lang', 'url');

		$this->insert('lang', [
			'url'        => 'uk',
			'local'      => 'uk-UA',
			'name'       => 'Український',
			'created_at' => time(),
			'updated_at' => time(),
		]);
		$this->insert('lang', [
			'url'        => 'ru',
			'local'      => 'ru-RU',
			'name'       => 'Русский',
			'default'    => 1,
			'created_at' => time(),
			'updated_at' => time(),
		]);
		$this->insert('lang', [
			'url'        => 'en',
			'local'      => 'en-US',
			'name'       => 'English',
			'created_at' => time(),
			'updated_at' => time(),
		]);
	}

	public function down()
	{
		$this->dropTable('lang');
	}
}
