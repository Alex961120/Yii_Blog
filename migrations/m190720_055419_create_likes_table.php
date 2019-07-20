<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%likes}}`.
 */
class m190720_055419_create_likes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%likes}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull(),
            'blog_id'    => $this->integer()->notNull(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%likes}}');
    }
}
