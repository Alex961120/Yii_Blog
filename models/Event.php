<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property int $user_id
 * @property string $target_type
 * @property int $target_id
 * @property int $action_id
 * @property string $updated_at
 * @property string $created_at
 */
class Event extends \yii\db\ActiveRecord
{
    const REPOST = '转发';
    const PUBLISH = '发布';
    const LIKE = '赞';
    const FOLLOW = '关注';
    const COMMENT = '评论';
    const DELETE = '删除';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'target_type', 'target_id'], 'required'],
            [['user_id', 'target_id', 'action_id'], 'integer'],
            [['updated_at', 'created_at'], 'default', 'value' => date('Y-m-d H:i:s', time())],
            [['target_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'user_id'     => 'User ID',
            'target_type' => 'Target Type',
            'target_id'   => 'Target ID',
            'action_id'   => 'Action ID',
            'updated_at'  => 'Updated At',
            'created_at'  => 'Created At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'action_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->target_type == Blog::className()) {
            $blog = Blog::findOne($this->target_id);
            $blog->popularity_count++;
            return $blog->save();
        }
        return true;
    }

    public function afterDelete()
    {
        if ($this->target_type == Blog::className()) {
            $blog = Blog::findOne($this->target_id);
            $blog->popularity_count--;
            return $blog->save();
        }
    }

    public static function create($target_type, $target_id, $action_type, $action_id = NULL)
    {
        $event              = new Event();
        $event->user_id     = Yii::$app->user->id;
        $event->target_type = $target_type;
        $event->target_id   = $target_id;
        $event->action_type = $action_type;
        if ($action_id) {
            $event->action_id = $action_id;
        }
        return $event->save();
    }

    public static function destroy($target_type, $target_id, $action_type)
    {
        if ($event = Event::find()->where([
            'user_id'     => Yii::$app->user->id,
            'target_type' => $target_type,
            'target_id'   => $target_id,
            'action_type' => $action_type,
        ])->one()) {
            return $event->delete();
        }

        return true;
    }
}
