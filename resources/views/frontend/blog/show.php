<?php $this->layout('frontend/template') ?>

<main>
    <div class="ui container blog-container">
        <div class="main-container">

            <div class="ui stackable grid">
                <div class="twelve wide column">

                    <div class="ui breadcrumb unimportant-text"
                         itemscope
                         itemtype="http://data-vocabulary.org/Breadcrumb"
                    >
                        <a href="/"
                           class="section"
                           itemprop="url"
                        >
                            Home
                            <span itemprop="title" class="hide">gulchuk.com</span>
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