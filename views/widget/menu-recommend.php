<div class="menu">
    <div class="menu-recommend">
        <h5>推荐用户</h5>
        <?php foreach ($users as $user): ?>
            <?php if ($user->id != Yii::$app->user->id): ?>
                <p>
                    <a href="?r=user/show&id=<?= $user->id ?>">
                        <img src="/images/upload/<?= $user->avatar ?>">
                        <?= $user->name ?>
                    </a>
                </p>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>