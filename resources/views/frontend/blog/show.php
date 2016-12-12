<?php $this->layout('frontend/template') ?>

<main>
    <div class="ui container blog-container">
        <div class="main-container">

            <div class="ui stackable grid">
                <div class="twelve wide column">

                    <h1 class="ui huge header">
                        <?= $this->e($article->title) ?>
                    </h1>

                    <p class="unimportant-text">
                        <?= $article->created_at->format('j M Y') ?>
                    </p>

                    <p class="content-text">
                        <?= $article->content ?>
                    </p>

                </div>

                <div class="four wide column">
                    <?php $this->insert('frontend/blog/includes/tags', ['tags' => $tags]) ?>
                </div>

            </div>

        </div>
    </div>
</main>