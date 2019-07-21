<?php

namespace app\controllers;

use app\models\Blog;
use app\models\Event;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class BlogController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['store', 'repost'],
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

    public function actionIndex()
    {
        $blogs = Blog::find()->orderBy('id desc')->all();
        return $this->render('index', compact('blogs'));
    }

    public function actionStore()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Blog();

        if ($filenames = Yii::$app->request->post('filenames')) {
            // 将图片信息存入对应的模型当中
            $model->img = json_encode($filenames);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // 触发发布事件
            Event::create(Blog::className(), $model->id, '发布');

            return $this->goHome();
        }

        return $model->errors;
    }

    public function actionRepost()
    {
        if (!($repost_blog = Blog::findOne(Yii::$app->request->post('Blog')['id']))) {
            return $this->goBack();
        }

        # 转发源状态
        if ($repost_blog->origin_id != $repost_blog->id && ($orgin_blog = Blog::findOne($repost_blog->origin_id))) {
            // 触发发布事件
            Event::create(Blog::className(), $orgin_blog->id, '转发');
        }

        $model            = new Blog();
        $model->parent_id = $repost_blog->id;
        $model->origin_id = $repost_blog->origin_id ?? $repost_blog->id;

        if ($filenames = Yii::$app->request->post('filenames')) {
            // 将图片信息存入对应的模型当中
            $model->img = json_encode($filenames);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // 触发发布事件
            Event::create(Blog::className(), $model->id, '发布');

            return $this->goBack();
        }
        return $model->errors;
    }

    public function actionDelete($id)
    {
        $blog = Blog::findOne($id);
        if ($blog->user_id == Yii::$app->user->id) {
            Event::destroy(Blog::className(), $id,"删除");
            $blog->delete();
        }
        return $this->goHome();
    }

}
