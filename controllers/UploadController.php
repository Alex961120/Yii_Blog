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

    public function actionAvatar()
    {
        if ($filename = Yii::$app->request->post('filenames')) {
            $user         = User::findOne(Yii::$app->user->id);
            $user->avatar = $filename[0];
            if ($user->save()) {
                return $this->goBack();
            }
            $errors = $user->errors;
        } else {
            $model             = new UploadForm();
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($filenames = $model->upload()) {
                return "<script>parent.preview('$filenames')</script>";
            }
            $errors = $model->errors;
        }
        return $errors;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
