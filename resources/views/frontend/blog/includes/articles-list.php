<?php if (count($articles)) : ?>

    <?php foreach ($articles as $article): ?>
        <div class="ui large header">

            <a class="link-title" href="/blog/<?= $article->slug ?>">
                <?= $this->e($article->title) ?>
            </a>

            <div class="sub header">
                <?= $article->createdDateInFormat() ?>
            </div>

        </div>
    <?php endforeach; ?>

<?php endif; ?>