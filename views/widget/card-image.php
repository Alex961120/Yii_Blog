<p class="card-img">
    <?php foreach (json_decode($imgs) as $img): ?>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#previewModal">
            <img src="/images/upload/<?= $img ?>">
        </a>
    <?php endforeach; ?>
</p>