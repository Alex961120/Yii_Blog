<?php

namespace app\widgets;

use app\models\Topic;

class MenuTopicWidget extends \yii\bootstrap\Widget
{
    public $topics;

    public function run()
    {
        $topics = $this->topics ?? Topic::page(1, 5);
        if ($topics) {
            return $this->render('@app/views/widget/menu-topic', compact('topics'));
        }
    }
}