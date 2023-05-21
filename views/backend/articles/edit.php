<?php /** @var $this \League\Plates\Template\Template */ ?>
<?php $this->layout('backend/template') ?>

<div class="container">

    <div class="ui grid">

        <div class="middle aligned twelve wide column">
            <h1 class="ui header">
                <div class="content">
                    Edit article &laquo;<?= $this->e($article->title) ?>&raquo;
                    <div class="sub header">
                        Edit blog article form
                    </div>
                </div>
            </h1>
        </div>

        <div class="middle aligned right aligned four wide column">
            <?php if($article->is_published): ?>
                <span class="ui green big label">Published</span>
            <?php else: ?>
                <span class="ui grey big label">Unpublished</span>
            <?php endif; ?>
        </div>

    </div>

    <div class="ui clearing divider"></div>

    <?php $this->insert('backend/articles/includes/form', [
        'article' => $article,
        'redirectUrl' => $redirectUrl,
        'tags' => $tags,
        'article_tags' => $article_tags
    ]) ?>

</div>