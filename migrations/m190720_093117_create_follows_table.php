<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%follows}}`.
 */
class m190720_093117_create_follows_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%follows}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'followed_user_id' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp(),
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%follows}}');
    }
}
