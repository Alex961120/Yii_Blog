<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blogs".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $origin_id
 * @property int $user_id
 * @property int $popularity_count
 * @property string $text
 * @property string $img
 * @property string $updated_at
 * @property string $created_at
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['user_id', 'default', 'value' => Yii::$app->user->id],
            [['text'], 'string', 'max' => 255],
            [['updated_at', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'               => 'ID',
            'parent_id'        => 'Parent ID',
            'origin_id'        => 'Origin ID',
            'user_id'          => 'User ID',
            'popularity_count' => 'Popularity Count',
            'text'             => '说点什么',
            'img'              => 'Img',
            'updated_at'       => 'Updated At',
            'created_at'       => 'Created At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getParent()
    {
        return $this->hasOne(Blog::className(), ['id' => 'parent_id']); // 通过当前博客的 parent_id 与 上一级博客的 id 建立对应关系
    }

    public function getOrigin()
    {
        return $this->hasOne(Blog::className(), ['id' => 'origin_id']);
    }
}
