<?php /** @var $this \League\Plates\Template\Template */ ?>

<?php $this->layout('frontend/template',[
    'title' => $this->e($article->seo_title),
    'description' => $this->e($article->seo_description),
    'keywords' => $this->e($article->seo_keywords),
    'image' => $article->social_image,
    'styles' => [
        '/build/' . config('app.version') . '/h.css'
    ],
    'scripts' => [
        [
            'load' => 'defer',
            'src' => '/build/' . config('app.version') . '/h.js'
        ]
    ]
]) ?>

<main>
    <div class="ui container blog-container">
        <div class="main-container">

            <div class="ui stackable grid">
                <div class="twelve wide column" itemscope="" itemtype="http://schema.org/Article">

                    <div class="ui breadcrumb unimportant-text"
                         itemscope
                         itemtype="http://data-vocabulary.org/Breadcrumb"
                    >
                        <a href="/"
                           class="section"
                           itemprop="url"
                        >
                            Home
                            <span itemprop="title" class="display-none">gulchuk.com</span>
                        </a>

                        <span class="divider"> / </span>

                        <span itemscope
                              itemtype="http://data-vocabulary.org/Breadcrumb"
                              itemprop="child"
                        >
                            <a href="/blog" itemprop="url" class="section">
                                <span itemprop="title">Blog
                                </span>
                            </a>
                        </span>

                        <span class="divider"> / </span>

                        <span class="active section"><?= $this->e($article->title) ?></span>

                    </div>

                    <h1 class="ui huge header" itemprop="headline">
                        <?= $this->e($article->title) ?>
                    </h1>

                    <p class="unimportant-text" itemprop="datePublished">
                        <?= $article->created_at->format('j M Y') ?>
                    </p>

                    <?php if($article->updated_at): ?>
                        <meta itemprop="dateModified" content="<?= $article->created_at->format('Y-m-d') ?>"/>
                    <?php endif; ?>

                    <meta itemscope itemprop="mainEntityOfPage"
                          itemType="http://schema.org/WebPage"
                          itemid="<?= config('app_url') ?>/blog/<?= $article->slug ?>"/>

                    <div class="display-none" itemprop="author" itemscope itemtype="http://schema.org/Person">
                        <span itemprop="name">Volodymyr Gulchuk</span>
                        <span itemprop="url"><?= config('app_url') ?></span>
                    </div>

                    <div class="display-none" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
                        <span itemprop="name">Gulchuk.com</span>
                        <span itemprop="url"><?= config('app_url') ?></span>
                        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                            <meta itemprop="url" content="<?= config('app_url') ?>/assets/favicon/android-chrome-512x512.png">
                            <meta itemprop="width" content="512">
                            <meta itemprop="height" content="512">
                        </div>
                    </div>

                    <div class="display-none" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <meta itemprop="url" content="<?= config('app_url') . $article->social_image ?>">
                        <meta itemprop="width" content="1200">
                        <meta itemprop="height" content="630">
                    </div>

                    <article class="content-text" itemprop="articleBody">
                        <?= $article->content ?>
                    </article>

                </div>

                <div class="four wide column">
                    <?php $this->insert('frontend/blog/includes/tags', ['tags' => $tags]) ?>
                </div>

            </div>

        </div>
    </div>
</main>