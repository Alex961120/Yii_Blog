<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use app\models\Blog;

$blogModel = new Blog();

?>
<?php $form = ActiveForm::begin([
    'action'  => $options['action'] ?? ['blog/store'],
    'options' => [
        'enctype' => 'multipart/form-data',
    ]
]); ?>

<?= $form->field($blogModel, 'text')->textarea(['rows' => 3])->label('说点什么') ?>
<?= $form->field($blogModel, 'id')->hiddenInput()->label(false) ?>

    <div class="form-group" style="text-align:right">
        <?= Html::submitButton('发布', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>