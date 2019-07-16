<?php

namespace app\controllers;

use Yii;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

class UploadController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['avatar', 'blog'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    # 显示iframe域
    public function actionBlog()
    {
        $model             = new UploadForm();
        $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
        if ($filenames = $model->upload()) {
            return "<script>parent.preview('$filenames')</script>";
        }
        return $model->errors;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
