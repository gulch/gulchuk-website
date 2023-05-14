<?php

/** @var \League\Plates\Template\Template $this */ ?>
<div class="ui warning large form segment">
    <form method="POST" action="/<?= config('app.backend_segment') ?>/articles/save" accept-charset="UTF-8">

        <input type="hidden" id="redirect_url" value="<?= $redirectUrl ?? '/' . config('app.backend_segment') . '/articles' ?>">

        <?php if (isset($article)) : ?>
            <input type="hidden" name="id" value="<?= $article->id ?>">
        <?php endif; ?>

        <div class="fields center aligned">
            <div class="eight wide field">
                <label for="name">Title*</label>
                <input name="title" type="text" value="<?= isset($article) ? $this->e($article->title) : '' ?>">
            </div>

            <div class="one wide field">
                <label>&nbsp;</label>

                <div id="translit-button" class="ui fluid basic icon large button" tabindex="0">
                    <i class="right arrow icon"></i>
                </div>
            </div>

            <div class="seven wide field">
                <label for="slug">Slug*</label>
                <input class="slug-field" name="slug" type="text" id="slug" value="<?= isset($article) ? $this->e($article->slug) : '' ?>">
            </div>
        </div>

        <div class="ui field">
            <label for="content">Content*</label>
            <textarea name="content" id="content" data-upload-url="/<?= config('app.backend_segment') ?>/images/upload" class="wysiwyg-editor" cols="30" rows="10"><?= isset($article) ? $this->e($article->content) : '' ?></textarea>
        </div>

        <div class="ui field">
            <label for="article_tags[]">Tags</label>
            <select name="article_tags[]" class="ui fluid search dropdown" multiple>
                <?php if (sizeof($tags)) : ?>
                    <?php foreach ($tags as $tag) : ?>
                        <option <?= in_array($tag->id, $article_tags) ? 'selected' : '' ?> value="<?= $tag->id ?>"><?= $this->e($tag->title) ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <?php $this->insert('backend/includes/seo-fields', [
            'item' => isset($article) ? $article : null
        ]) ?>

        <?php $this->insert('backend/includes/submit-buttons') ?>

    </form>
</div>

<?php $this->insert('backend/includes/wysiwyg-editor') ?>