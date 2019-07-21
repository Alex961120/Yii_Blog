<?php

namespace app\controllers;

use app\models\Blog;

class EventController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionShow($id)
    {
        // 取出当前状态的所有热度
        $blog = Blog::find()->where(['id' => $id])->with(['events' => function ($q) {
            $q->with([
                'user' => function ($q) {
                    $q->select('id,name,avatar');
                },
                'comment'
            ])->orderBy('id desc');
        }])->one();

        return $this->render('show', compact('blog'));
    }

}
