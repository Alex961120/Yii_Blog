<div class="card-container">
    <?= app\widgets\BlogWidget::widget(['blogs' => [$blog]]) ?>

    <?php if ($blog->events): ?>
        <div class="card">
            <div class="card-content">
                <?php foreach ($blog->events as $event): ?>
                    <!-- 热度-->
                    <p class="comment">
                        <a href="?r=user/show&id=<? $event->user->id ?>"><img src="/images/upload/<?=$event->user->avatar?>"> <?= $event->user->name?></a>
                        <span class="comment-btn"><?= $event->created_at ?></span>
                        <?=$event->action_type?>了状态
                    </p>
                    <?php if (!empty($event->comment->content) && $event->action_type == '评论'): ?>
                    <p class="comment-content">
                        <?=$event->comment->content?>
                    </p>
                    <?php endif;?>
                    <!-- /热度-->
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php

$css = <<<CSS
.popularity img {
    width:40px;
    height:40px;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}
.popularity-timestamp{
    float: right;
    margin: 10px 10px 0 0;
}
.popularity-comment {
    background-color: #eee;
    padding: 10px;
    margin-left: 40px;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}
CSS;

$this->registerCss($css);

?>