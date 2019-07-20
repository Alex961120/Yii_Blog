<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m190717_051653_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull(),
            'blog_id'    => $this->integer()->notNull(),
            'content'    => $this->string()->notNull(),
            'parent_id'  => $this->integer(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp(),
        ], 'ENGINE=InnoDB CHARSET=utf8mb4');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comments}}');
    }
}
