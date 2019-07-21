<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%topic_blog}}`.
 */
class m190721_084040_create_topic_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%topic_blog}}', [
            'id'         => $this->primaryKey(),
            'topic_id'   => $this->integer()->notNull(),
            'blog_id'    => $this->integer()->notNull(),
            'updated_at' => $this->timestamp() . ' DEFAULT now()',
            'created_at' => $this->timestamp() . ' DEFAULT now()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%topic_blog}}');
    }
}
