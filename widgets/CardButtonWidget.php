<?php

namespace app\widgets;

class CardButtonWidget extends \yii\bootstrap\Widget
{
    public $blog;

    public function run()
    {
        $blog = $this->blog;
        return $this->render('@app/views/widget/card-btn',compact('blog'));
    }


}