<?php

use yii\bootstrap\Html;

?>

<div class="card-container">

    <?php if (!(Yii::$app->user->isGuest)) : ?>

        <div class="card">
            <div class="card-avatar">
                <?= Html::a(Html::img("/images/upload/" . (Yii::$app->user->identity->avatar ?? "default.jpg")), ["user/show", "id" => Yii::$app->user->id]) ?>
            </div>

            <div class="card-content">
                <?= app\widgets\PublishFormWidget::widget() ?>
            </div>
        </div>

    <?php endif ?>

    <?= app\widgets\BlogWidget::widget(compact('blogs')) ?>
</div>

<div class="menu-container">

    <?= app\widgets\MenuUserWidget::widget() ?>
    <?= app\widgets\MenuTopicWidget::widget() ?>
    <?= app\widgets\MenuRecommendWidget::widget() ?>

</div>