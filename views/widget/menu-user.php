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
