<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_id
 * @property string $content
 * @property int $parent_id
 * @property string $updated_at
 * @property string $created_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_id', 'content'], 'required'],
            [['blog_id', 'parent_id'], 'integer'],
            ['user_id', 'default', 'value' => Yii::$app->user->id],
            [['updated_at', 'created_at'], 'default', 'value' => date('Y-m-d H:i:s', time())],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'user_id'    => 'User ID',
            'blog_id'    => 'Blog ID',
            'content'    => 'Content',
            'parent_id'  => 'Parent ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getParent()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }
}
