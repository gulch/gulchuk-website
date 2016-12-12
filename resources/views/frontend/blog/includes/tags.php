<?php if (sizeof($tags)): ?>
    <div class="ui header unimportant-text">
        Tags
    </div>
    <?php foreach ($tags as $tag): ?>
        <a class="blog-tag-link"
           href="/blog/tag/<?= $this->e($tag->slug) ?>"
        ><?= $this->e($tag->title) ?></a>
    <?php endforeach; ?>
<?php endif; ?>