<?php

/** @var \League\Plates\Template\Template $this */
$this->layout('frontend/template', [
    'title' => $this->e($article->seo_title),
    'description' => $this->e($article->seo_description),
    'keywords' => $this->e($article->seo_keywords),
    'image' => $article->social_image,
    'styles' => [
        g_asset('h.css'),
    ],
    'scripts' => [
        [
            'load' => 'defer',
            'src' => g_asset('h.js'),
        ]
    ]
]) ?>

<main class="ui container blog-container">
    <div class="main-container">

        <div class="ui stackable grid">
            <div class="twelve wide column">

                <div class="ui breadcrumb unimportant-text">

                    <a href="/" class="section">
                        Home
                    </a>

                    <span class="divider"> / </span>

                    <a href="/blog" class="section">
                        Blog
                    </a>

                    <span class="divider"> / </span>

                    <span class="active section"><?= $this->e($article->title) ?></span>

                </div>

                <h1 class="ui huge header">
                    <?= $this->e($article->title) ?>
                </h1>

                <p class="unimportant-text">
                    <?= $article->created_at->format('j M Y') ?>
                </p>

                <article class="content-text">
                    <?= $article->content ?>
                </article>

            </div>

            <div class="four wide column">
                <?php $this->insert('frontend/blog/includes/tags', ['tags' => $tags]) ?>
            </div>

        </div>

    </div>
</main>
