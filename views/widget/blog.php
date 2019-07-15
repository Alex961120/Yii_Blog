<?php

use yii\helpers\Url;
use yii\bootstrap\Html;

?>

<?php if (empty($blogs)): ?>
    <div class="card-container">还没发过状态</div>
<?php endif ?>


<?php foreach ($blogs as $blog): ?>
    <div class="card">
        <!-- 头像 -->
        <div class="card-avatar">
            <?= Html::a(Html::img('/images/upload/' . $blog->user->avatar), ['user/show', 'id' => $blog->user->id]); ?>
        </div>
        <!-- /头像 -->

        <!-- 内容 -->
        <div class="card-content">

            <!-- 标题 -->
            <p class="card-title">
                <?= Html::a($blog->user->name, ['user/show', 'id' => $blog->user->id]); ?>
            </p>
            <!-- /标题 -->

            <!-- 状态 -->
            <p class="cart-status">
                <?= $blog->created_at ?> <?= $blog->parent_id ? '转发' : '发布' ?>了状态
            </p>
            <!-- /状态 -->


            <?php if ($blog->parent_id): ?><!-- 转发 -->
            <p class="card-text">
                <?= empty($blog->text) ? '转发了' : $blog->text ?>
            </p>

            <div class="repost">
                <!-- 转发标题 -->
                <p class="card-title">
                    <?php if ($blog->parent): ?>
                        <a href="<?= Url::to(['user/show', 'id' => $blog->parent->user->id]) ?>"><?= $blog->parent->user->name ?></a>
                    <?php else: ?>
                        原微博已被删除
                    <?php endif; ?>
                </p>
                <!-- /转发标题 -->
                <p class="card-text">
                    <?= $blog->origin->text ?>
                </p>
                <?= app\widgets\CardButtonWidget::widget(['blog' => $blog->origin]) ?>
            </div>
            <!-- /转发 -->
            <?php else: ?>
                <p class="card-text">
                    <?= $blog->text ?>
                </p>
            <?php endif; ?>

            <?= app\widgets\CardButtonWidget::widget(['blog' => $blog]) ?>

        </div>
        <!-- /内容 -->
    </div>
<?php endforeach; ?>


