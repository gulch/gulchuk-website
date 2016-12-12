<?php $this->layout('frontend/template') ?>

<main>
    <div class="ui container blog-container">

        <div class="ui stackable grid">
            <div class="twelve wide column">

                <h1 class="ui huge header blog-header-title blog-tag-link">
                    <?= $this->e($tag->title) ?>
                </h1>
                <p>
                    <?= $tag->content ?>
                </p>

                <div class="ui hidden divider"></div>

                <?php $this->insert('frontend/blog/includes/articles-list', ['articles' => $articles]) ?>
            </div>

            <div class="four wide column">
                <?php $this->insert('frontend/blog/includes/tags', ['tags' => $tags]) ?>
            </div>

        </div>
    </div>
</main>