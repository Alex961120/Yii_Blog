<?php

namespace app\controllers;

use app\models\Blog;
use app\models\Event;
use app\models\Like;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class LikeController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['save'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'store'  => ['post'],
                    'repost' => ['post'],
                ]
            ]
        ];
    }

    public function actionSave()
    {
        $uid = Yii::$app->user->id;
        $bid = Yii::$app->request->post('id');

        if ($like = Like::find()->where(['user_id' => $uid, 'blog_id' => $bid])->one()) {
            // 如果已经点赞，则删除此条点赞记录，并返回 -1
            Like::findOne($like->id)->delete();
            Event::destroy(Blog::className(), $like->blog_id, '赞');

            return -1;
        } else {
            // 没有点赞则创建一个 Like 模型，设置好相应的 user_id 和 blog_id 后插入数据库，返回 1
            $like          = new Like();
            $like->user_id = $uid;
            $like->blog_id = $bid;
            $like->save();
            Event::create(Blog::className(), $like->blog_id, '赞', $like->id);

            return 1;
        }
    }

}
