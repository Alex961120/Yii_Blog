<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

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
            [['updated_at', 'created_at'], 'default', 'value' => date('Y-m-d H:i:s', time())],
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

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['blog_id' => 'id']);
    }

    public function afterDelete()
    {
        Comment::deleteAll(['blog_id' => $this->id]);
    }

    public function getLike()
    {
        return $this->hasOne(Like::className(), ['blog_id' => 'id'])->where(['user_id' => Yii::$app->user->id]);
    }

    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        # 正则表达式匹配我们发布时的话题内容
        preg_match_all("/#(.*?)#/", $this->text, $matches);

        if (empty($matches)) {
            return true;
        }

        foreach ($matches[1] as $key => $name) {
            # 如果当前发布话题不存在 则新建话题
            if (!($topic = Topic::findOne(['name' => $name]))) {
                $topic          = new Topic();
                $topic->name    = $name;
                $topic->user_id = Yii::$app->user->id;
            }
            # 如果话题存在 该话题下的状态数量+1
            $topic->blog_count++;
            if (!$topic->save()) {
                return false;
            }
            # 将新生成的话题装载
            $this->topic_id[] = $topic->id;
        }
        return true;
    }

    public $topic_id;

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if (!empty($this->topic_id)) {
            // 更新话题与状态的关系
            foreach ($this->topic_id as $topic_id) {
                $topic_blog           = new TopicBlog();
                $topic_blog->topic_id = $topic_id;
                $topic_blog->blog_id  = $this->id;
                if (!$topic_blog->save()) {
                    return false;
                }
            }
        }
        return true;
    }

    public function getTopics()
    {
        return $this->hasMany(Topic::className(), ['id' => 'topic_id'])->viaTable(TopicBlog::tableName(), ['blog_id' => 'id']);
    }

    public function text()
    {
        if (empty($this->topics)) {
            return $this->text;
        }
        $replace = $find = [];
        foreach ($this->topics as $topic) {
            $name      = '#' . $topic['name'] . '#';
            $find[]    = $name;
            $replace[] = Html::a($name, ['topic/show', 'id' => $topic['id']]);
        }
        return str_replace($find, $replace, $this->text);
    }

    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['target_id' => 'id']);
    }
}
