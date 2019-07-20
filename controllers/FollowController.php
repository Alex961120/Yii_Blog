<?php

namespace app\controllers;

use app\models\Follow;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class FollowController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['user'],
                'rules' => [
                    [
                        'actions' => ['user'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionUser($id)
    {
        // 判断区分登录用户和被关注用户，用户不能关注自己
        if (Yii::$app->user->id != $id) {
            // 创建一个数组，设置 user_id 为登录用户的 id，被关注用户 id 为方法传递进来的参数 $id
            $data = [
                'user_id'          => Yii::$app->user->id,
                'followed_user_id' => $id
            ];

            if ($follow = Follow::findOne($data)) {
                $follow->delete();
            } else {
                $follow             = new Follow();
                $follow->attributes = $data;// 批量赋值
                $follow->save();
            }
            // referrer 指上个路由
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

}
