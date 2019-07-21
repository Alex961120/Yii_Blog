<div class="menu">
    <div class="menu-topic" data-page=1>


        <div class="menu-topic-title">
            <h5>话题列表
                <?= yii\bootstrap\Html::a(yii\bootstrap\Html::icon('refresh', 'javascript:void(0)', ['class' => 'refresh'])) ?>
            </h5>
        </div>

        <div class="menu-topic-list">
            <?php foreach ($topics as $topic):?>
            <p><a href="?r=topic/show&id=<?=$topic['id']?>">#<?=$topic['name']?></a></p>
            <?endforeach;?>
        </div>
    </div>
</div>