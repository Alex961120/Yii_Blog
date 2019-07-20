<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "follows".
 *
 * @property int $id
 * @property int $user_id
 * @property int $followed_user_id
 * @property string $updated_at
 * @property string $created_at
 */
class Follow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'follows';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'followed_user_id'], 'required'],
            [['user_id', 'followed_user_id'], 'integer'],
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
            'user_id'          => 'User ID',
            'followed_user_id' => 'Followed User ID',
            'updated_at'       => 'Updated At',
            'created_at'       => 'Created At',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $follow_user = User::findOne($this->user_id);
        $follow_user->followed_count++;

        if (!$follow_user->save()) {
            return false;
        }

        $followed_user = User::findOne($this->followed_user_id);
        $followed_user->follower_count++;

        if (!$followed_user->save()) {
            return false;
        }

        return true;


    }
}
