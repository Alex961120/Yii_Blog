<?php

namespace app\controllers;

use app\models\User;
use Yii;

class UserController extends \yii\web\Controller
{
    public function actionShow($id = NULL)
    {
        // 关联查询 users、blogs
        $user = User::find()->where(['id' => $id ?? Yii::$app->user->id])->with('blogs')->one();
        return $this->render('show', compact('user'));
    }

}
