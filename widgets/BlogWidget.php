<?php

namespace app\widgets;

use Yii;
use app\models\Blog;

class BlogWidget extends \yii\bootstrap\Widget
{
    public $blogs;

    public function run()
    {
        $blogs = $this->blogs;
        return $this->render('@app/views/widget/blog', compact('blogs'));
    }
}