<?php

use yii\bootstrap\Modal;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="menu">
    <div class="menu-avatar">
        <a href="javascript:void (0)">
            <img src="/images/upload/<?= $user->avatar ?>">
        </a>

        <h4><?= $user->name ?></h4>

        <p class="menu-btn">
            <a href="#">动态 <em> <?= count($user->blogs) ?></em></a>
            <a href="#">关注 <em> <?= $user->followed_count ?></em></a>
            <a href="#">粉丝 <em> <?= $user->follower_count ?></em></a>
        </p>
    </div>
</div>

<?php if (Yii::$app->user->id == $user->id): ?>

    <?php
    Modal::begin([
        'header'  => '<h4>上传头像</h4>',
        'options' => [
            'id' => 'uploadModal',
        ]
    ]);

    $form = ActiveForm::begin([
        'action'  => '?=upload/avatar',
        'options' => [
            'class'   => 'upload-form upload-avatar-form',
            'enctype' => 'multipart/form-data',
        ]
    ]);
    ?>
    <?= $form->field(new app\models\UploadForm(), 'imageFiles')->fileInput(['class' => 'upload-avatar-input hidden'])->label(false) ?>

    <div class="form-group upload-images upload-avatar">
        <a class="btn-form-img" href="javascript:void(0)">
            <img src="/images/upload/<?= $user->avatar ?>">
        </a>
    </div>
    <div class="form-group" style="text-align: right">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php
    ActiveForm::end();
    Modal::end();

    $js = <<<JS
$(".upload-avatar-input").change(function() {
    $(".upload-avatar-form").attr('target','upload-iframe');
    $(".upload-avatar-form").submit(); 
})
JS;
    $this->registerJs($js);
    ?>
<?php endif; ?>
