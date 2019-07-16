<?php

namespace app\controllers;

use app\models\Blog;
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
        $model = new Blog();

        if ($filenames = Yii::$app->request->post('filenames')) {
            // 将图片信息存入对应的模型当中
            $model->img = json_encode($filenames);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goHome();
        }

        return $model->errors;
    }

    public function actionRepost()
    {
        if (!($repost_blog = Blog::findOne(Yii::$app->request->post('Blog')['id']))) {
            return $this->goBack();
        }

        $model            = new Blog();
        $model->parent_id = $repost_blog->id;
        $model->origin_id = $repost_blog->origin_id ?? $repost_blog->id;

        if ($filenames = Yii::$app->request->post('filenames')) {
            // 将图片信息存入对应的模型当中
            $model->img = json_encode($filenames);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goBack();
        }
        return $model->errors;
    }

}
