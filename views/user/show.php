<div class="card-container">
    <?php if (empty($user->blogs)): ?>
        <div class="content">
            还没发过状态
        </div>
    <?php else: ?>
        <?= app\widgets\BlogWidget::widget(['blogs' => $user->blogs]) ?>
    <?php endif; ?>
</div>

<div class="menu-container">
    <?=app\widgets\MenuUserWidget::widget()?>
    <?=app\widgets\MenuRecommendWidget::widget()?>
</div>
