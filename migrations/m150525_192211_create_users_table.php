<?php

use yii\db\Schema;
use yii\db\Migration;

class m150525_192211_create_users_table extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        try {
            $this->createTable('user', [
                'id'             => Schema::TYPE_PK,
                'username'       => Schema::TYPE_STRING . ' NOT NULL',
                'full_name'      => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
                'position'       => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
                'email'          => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
                'phone'          => Schema::TYPE_STRING . '(32) NULL DEFAULT NULL',
                'skype'          => Schema::TYPE_STRING . '(32) NULL DEFAULT NULL',
                'photo'          => Schema::TYPE_STRING . '(255) NULL DEFAULT NULL',
                'auth_key'       => Schema::TYPE_STRING . '(32) NULL DEFAULT NULL',
                'password_hash'  => Schema::TYPE_STRING . ' NOT NULL',
                'status'         => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            ]);

            $this->addForeignKey('FK_auth_assignment_user', 'auth_assignment', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function safeDown()
    {
        try {
            $this->dropForeignKey('FK_auth_assignment_user', 'auth_assignment');
            $this->dropTable('user');
        } catch (Exception $e) {
            echo $e->getMessage();

            return false;
        }
    }
}
