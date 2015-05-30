<?php

use yii\db\Schema;
use yii\db\Migration;

class m150427_142315_add_column_user extends Migration
{
    public function up()
    {
		$this->addColumn('user', 'parent_user_id', Schema::TYPE_INTEGER);

	    $this->addForeignKey('FR_user_parent', 'user', 'parent_user_id', 'user', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FR_user_parent', 'user');
	    $this->dropColumn('user', 'parent_user_id');
    }
}
