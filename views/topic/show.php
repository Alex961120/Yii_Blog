<?php

use yii\bootstrap\Html;
use yii\helpers\Url;

?>

<div class="card-container">
    <div class="card">
        <div class="card-avatar">
            <?= Html::a(Html::img("images/upload/" . ($topic->user->avatar ?? 'default.jpg'))) ?>
        </div>

        <div class="card-content">
            <p class="card-title"><a
                        href="<?= Url::to(['user/show', 'id' => $topic->user_id]) ?>"><?= $topic->user->name ?></a>
            </p>
            <p class="card-status"><?= $topic->created_at ?> 创建了话题</p>
            <h4>#<?= $topic->name ?>#</h4>
        </div>
    </div>
    <?= app\widgets\BlogWidget::widget(['blogs' => $topic->blogs]) ?>
</div>

<div class="menu-container">
    <?=app\widgets\MenuTopicWidget::widget()?>
    <?=app\widgets\MenuRecommendWidget::widget()?>
</div>

