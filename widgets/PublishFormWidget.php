<?php

namespace app\widgets;

use Yii;

class PublishFormWidget extends \yii\bootstrap\Widget
{
    public $options;

    public function run()
    {
        $options = $this->options;
        return $this->render('@app/views/widget/publish-form', compact('options'));
    }
}