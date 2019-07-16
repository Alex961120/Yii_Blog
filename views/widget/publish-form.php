<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use app\models\Blog;

$blogModel = new Blog();

?>
<?php $form = ActiveForm::begin([
    'action'  => $options['action'] ?? ['blog/store'],
    'options' => [
        'class'   => 'upload-form upload-blog-form',
        'enctype' => 'multipart/form-data',
    ]
]); ?>

<?= $form->field($blogModel, 'text')->textarea(['rows' => 3])->label('说点什么') ?>
<?= $form->field($blogModel, 'id')->hiddenInput()->label(false) ?>
<?= $form->field(new app\models\UploadForm(), 'imageFiles[]')->fileInput(['class' => 'upload-blog-input hidden', 'multiple' => true, 'accept' => 'image/*'])->label(false) ?>

<div class="btn-form">
    <?= Html::a(Html::icon('picture') . ' 图片', 'javascript:void(0)', ['class' => 'btn-form-img']) ?>
    <?= Html::a(Html::icon('paperclip') . ' 话题', 'javascript:void(0)', ['class' => 'btn-form-topic']) ?>
</div>

<div class="form-group upload-images upload-blog"></div>

<div class="form-group" style="text-align:right">
    <?= Html::submitButton('发布', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
<iframe class="upload-iframe" name="upload-iframe" style="display:none;"></iframe>
