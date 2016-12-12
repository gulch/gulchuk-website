<?php $this->layout('frontend/template') ?>

<main>
    <div class="ui container blog-container">

        <h1 class="ui huge header blog-header-title">
            Blog
        </h1>

        <div class="ui hidden divider"></div>

        <div class="ui stackable grid">
            <div class="twelve wide column">
                <?php foreach ($articles as $article): ?>

                    <div class="ui large header">
                        <a href="/blog/<?= $article->slug ?>">
                            <?= $article->title ?>
                        </a>
                        <div class="sub header">
                            <?= $article->created_at->format('j M Y') ?>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

            <div class="four wide column">
                <?php $this->insert('frontend/blog/includes/tags') ?>
            </div>

        </div>
    </div>
</main>