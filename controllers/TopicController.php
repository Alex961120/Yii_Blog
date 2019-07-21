<?php

namespace app\controllers;

use app\models\Topic;
use Yii;

class TopicController extends \yii\web\Controller
{
    public function actionShow($id)
    {
        $topic = Topic::find()->with('blogs')->where(['id' => $id])->one();
        return $this->render('show', compact('topic'));
    }

    public function actionList()
    {
        $size = 5;
        $page = Yii::$app->request->post('page') ?? 1;
        //
        if (!($topics = Topic::page($page, $size))) {
            $page   = 1;
            $topics = Topic::page($page, $size);
        }

        return json_encode(compact('topics','page'));
    }

}
