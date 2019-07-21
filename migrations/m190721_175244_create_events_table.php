<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 */
class m190721_175244_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events}}', [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer()->notNull(),
            'target_type' => $this->string()->notNull(),
            'target_id'   => $this->integer()->notNull(),
            'action_id'   => $this->integer(),
            'updated_at'  => $this->timestamp(),
            'created_at'  => $this->timestamp(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events}}');
    }
}
