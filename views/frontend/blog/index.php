<?php

/** @var \League\Plates\Template\Template $this */
$this->layout('frontend/template', [
    'title' => 'Blog > Articles :: Gulchuk Website',
    'description' => 'List of articles, publications about web development, technologies etc.',
    'keywords' => 'blog, articles, gulchuk, publications, web, dev, development',
]) ?>

<main class="ui container blog-container">

    <h1 class="ui huge header blog-header-title">
        Blog
    </h1>

    <div class="ui hidden divider"></div>

    <div class="ui stackable grid">
        <div class="twelve wide column">
            <?php $this->insert('frontend/blog/includes/articles-list', ['articles' => $articles]) ?>
        </div>

        <div class="four wide column">
            <?php $this->insert('frontend/blog/includes/tags', ['tags' => $tags]) ?>
        </div>

    </div>
</main>
