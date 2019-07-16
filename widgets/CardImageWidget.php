<?php

namespace app\widgets;

use Yii;

class CardImageWidget extends \yii\bootstrap\Widget
{
    public $imgs;

    // 这里获取图片信息，并将其传递给小部件进行渲染
    public function run()
    {
        $imgs = $this->imgs;
        return $this->render('@app/views/widget/card-image', compact('imgs'));
    }

}