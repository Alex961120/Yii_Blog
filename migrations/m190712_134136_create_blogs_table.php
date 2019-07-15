<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blogs}}`.
 */
class m190712_134136_create_blogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blogs}}', [
            'id'               => $this->primaryKey(),
            'parent_id'        => $this->integer(),
            'origin_id'        => $this->integer(),
            'user_id'          => $this->integer()->notNull(),
            'popularity_count' => $this->integer()->notNull()->defaultValue(0),
            'text'             => $this->string(),
            'img'              => $this->text(),
            'updated_at'       => $this->timestamp(),
            'created_at'       => $this->timestamp(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blogs}}');
    }
}
