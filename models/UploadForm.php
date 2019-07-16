<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $imageFiles;

    public function rules()
    {
        return [
            [
                ['imageFiles'],
                'file',  //  可以是文件或者文件数组
                'skipOnEmpty' => true,
                'extensions'  => ['jpg', 'jpeg', 'png', 'gif'],
                'maxFiles'    => 9 // 一次性最大上传数量
            ]
        ];
    }

    public function upload()
    {
        if (!$this->validate()) {
            return false;
        }
        // 遍历上传文件数组
        foreach ($this->imageFiles as $file) {
            $filename = Yii::$app->getSecurity()->generateRandomString() . '.' . $file->extension;
            $file->saveAs("images/upload/$filename");
            $filenames[] = $filename;
        }
        //返回文件数组序列化后的json数据
        return json_encode($filenames);
    }
}