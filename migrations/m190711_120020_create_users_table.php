<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190711_120020_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id'             => $this->primaryKey(),
            'name'           => $this->string()->notNull(),
            'email'          => $this->string()->notNull(),
            'password'       => $this->string()->notNull(),
            'avatar'         => $this->string()->notNull()->defaultValue('default.jpg'),
            'auth_key'       => $this->string(),
            'follower_count' => $this->integer()->notNull()->defaultValue(0),
            'followed_count' => $this->integer()->notNull()->defaultValue(0),
            'updated_at'     => $this->timestamp(),
            'created_at'     => $this->timestamp(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
