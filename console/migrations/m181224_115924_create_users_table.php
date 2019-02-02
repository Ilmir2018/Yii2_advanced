<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181224_115924_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'login' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'email' => $this->string()->notNull()
        ]);
        $this->createIndex("ix_users_id", "users", "id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
