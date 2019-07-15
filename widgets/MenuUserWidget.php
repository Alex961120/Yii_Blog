<?php

namespace app\widgets;

use Yii;
use app\models\User;

class MenuUserWidget extends \yii\bootstrap\Widget
{
    public function run()
    {
        if (Yii::$app->user->isGuest) {
            return <<<EOT
<div class="menu">  
<center><h4><a href="?r=site/login">登陆</a></h4></center>
</div>
EOT;
        } else {
            $con = Yii::$app->controller;

            $id = Yii::$app->user->id;
            if ($con->id == 'user' && $con->action->id == 'show') {
                $id = $con->actionParams['id'] ?? Yii::$app->user->id;
            }
            $user = User::findOne($id);
            return $this->render('@app/views/widget/menu-user', compact('user'));
        }
    }
}