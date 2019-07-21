<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "topic_blog".
 *
 * @property int $id
 * @property int $topic_id
 * @property int $blog_id
 * @property string $updated_at
 * @property string $created_at
 */
class TopicBlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'topic_blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['topic_id', 'blog_id'], 'required'],
            [['topic_id', 'blog_id'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic_id' => 'Topic ID',
            'blog_id' => 'Blog ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
