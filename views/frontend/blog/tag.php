<?php /** @var $this \League\Plates\Template\Template */ ?>

<?php
$this->layout('frontend/template', [
    'title' => $this->e($tag->seo_title),
    'description' => $this->e($tag->seo_description),
    'keywords' => $this->e($tag->seo_keywords),
    'styles' => [
        g_asset('h.css'),
    ],
    'scripts' => [
        [
            'load' => 'defer',
            'src' => g_asset('h.js'),
        ]
    ]
])
?>

<main>
    <div class="ui container blog-container">

        <div class="ui stackable grid">
            <div class="twelve wide column">

                <h1 class="ui huge header blog-header-title blog-tag-link">
                    <?= $this->e($tag->title) ?>
                </h1>
                <article>
                    <?= $tag->content ?>
                </article>

                <div class="ui hidden divider"></div>

                <?php $this->insert('frontend/blog/includes/articles-list', ['articles' => $articles]) ?>
            </div>

            <div class="four wide column">
                <?php $this->insert('frontend/blog/includes/tags', ['tags' => $tags]) ?>
            </div>

        </div>
    </div>
</main>
