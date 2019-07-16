<?php

use yii\bootstrap\Html;
use yii\bootstrap\Modal;

?>

    <p class="card-img">
        <?php foreach(json_decode($imgs) as $img) : ?>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#previewModal"><img src="/images/upload/<?=$img?>"></a>
        <?php endforeach ?>
    </p>

<?php
Modal::begin([
    'options' => [
        'id' => 'previewModel',
    ],
]) ?>
<?= Html::a(Html::icon('glyphicon glyphicon-chevron-left'), 'javascrpt:void(0)', ['class' => 'preview-img-btn prev-img']); ?>
<?= Html::img('/images/upload/default.jpg', ['class' => 'previewModal-img']); ?>
<?= Html::a(Html::icon('glyphicon glyphicon-chevron-right'), 'javascrpt:void(0)', ['class' => 'preview-img-btn next-img']); ?>

<?php Modal::end(); ?>