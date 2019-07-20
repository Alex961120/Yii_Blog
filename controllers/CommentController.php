<?php

namespace app\controllers;

use Yii;
use app\models\Blog;
use app\models\Comment;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CommentController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class'  => AccessControl::className(),
                'except' => ['show'],
                'rules'  => [
                    [
                        'actions' => ['save', 'delete'],
                        'allow'   => true,
                        'roles'   => ['@']
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'save' => ['post'],
                ]
            ]
        ];
    }

    public function actionShow($id)
    {
        $blog = Blog::find()->where(['id' => $id])->with(['user', 'comments' => function ($q) {
            $q->orderBy('id desc');
        }])->one();

        return $this->render('show', ['blog' => $blog, 'model' => new Comment()]);
    }

    public function actionSave()
    {
        $model          = new Comment();
        $model->user_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $model->errors;
    }

    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);
        if ($comment->user_id == Yii::$app->user->id) {
            $comment->delete();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

}
