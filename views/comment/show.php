<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use app\models\Blog;
use app\models\Comment;
use app\widgets\BlogWidget;

?>

<div class="card-container">
    <?= BlogWidget::widget(['blogs' => [$blog]]); ?>

    <div class="card">
        <div class="card-content">
            <!-- 评论 -->
            <?php $form = ActiveForm::begin([
                'action'  => '?r=comment/save',
                'options' => [
                    'id' => 'reply-form'
                ]
            ]); ?>

            <?= $form->field($model, 'content')->textInput()->label('评论(' . count($blog->comments) . ')') ?>
            <?= $form->field($model, 'blog_id', ['template' => '{input}'])->hiddenInput(['value' => $blog->id]) ?>
            <?= $form->field($model, 'parent_id', ['template' => '{input}'])->hiddenInput() ?>

            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <!-- /评论 -->

            <?php if($blog->comments):?>
            <?php foreach($blog->comments as $comment):?>

            <!-- 评论内容 -->
            <p class="comment">
                <a href="?=user/show&id=<?= $comment->user->id ?>">
                    <img src="/images/upload/<?= $comment->user->avatar ?>"> <?= $comment->user->name ?>
                </a>
                <?php if ($comment->parent_id): ?>
                    回复 <a href="?r=user/show$id=<?= $comment->parent->id ?>">@<?= $comment->parent->name ?></a>
                <?php endif ?>

                <span><?= $comment->created_at ?></span>
                <a href="javascript:void(0)" data-id=<?= $comment->user->id ?> data-name=<?= $comment->user->name ?>
                   class="comment-btn comment-reply">回复</a>

                <?php if ($comment->user->id == Yii::$app->user->id): ?>
                    <a href="?r=comment/delete&id=<?= $comment->id ?>" class="comment-btn comment-delete">删除</a>
                <?php endif ?>

                <p class="comment-content"><?= $comment->content ?></p>
            </p>

            <!-- /评论内容 -->
            <?php endforeach;?>
            <?php endif?>
        </div>
    </div>
</div>

<div class="menu-container">
    <?=app\widgets\MenuTopicWidget::widget()?>
    <?=app\widgets\MenuRecommendWidget::widget()?>
</div>