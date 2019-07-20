<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "likes".
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_id
 * @property string $updated_at
 * @property string $created_at
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'likes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'blog_id'], 'required'],
            [['user_id', 'blog_id'], 'integer'],
            [['updated_at', 'created_at'], 'default', 'value' => date('Y-m-d H:i:s', time())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'blog_id' => 'Blog ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
