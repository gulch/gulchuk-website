<?php if (sizeof($tags)): ?>
    <div class="ui header">
        Tags
    </div>
    <div>
        <?php foreach ($tags as $tag): ?>
            <a class="blog-tag-link link-color"
               href="/blog/tag/<?= $this->e($tag->slug) ?>"
            ><?= $this->e($tag->title) ?></a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>