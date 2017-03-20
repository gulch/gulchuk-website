<div class="ui warning large form segment">
    <form method="POST" action="/<?= config('backend_segment') ?>/tags/save" accept-charset="UTF-8">

        <input type="hidden" name="redirect_url" value="<?= $redirectUrl ?? '/'.config('backend_segment').'/tags' ?>">

        <?php if (isset($tag)): ?>
        <input type="hidden" name="id" value="<?= $tag->id ?>">
        <?php endif; ?>

        <div class="fields center aligned">
            <div class="eight wide field">
                <label for="name">Title*</label>
                <input name="title" type="text" value="">
            </div>

            <div class="one wide field">
                <label>&nbsp;</label>

                <div id="translit-button" class="ui fluid basic icon large button" tabindex="0">
                    <i class="right arrow icon"></i>
                </div>
            </div>

            <div class="seven wide field">
                <label for="slug">Slug*</label>
                <input class="slug-field" name="slug" type="text" id="slug">
            </div>
        </div>

        <div class="ui field">
            <label for="content">Content*</label>
            <textarea name="content" id="content" class="wysiwyg-editor" cols="30" rows="10"></textarea>
        </div>

        <?php $this->insert('backend/includes/submit-buttons') ?>

    </form>
</div>

<?php $this->insert('backend/includes/wysiwyg-editor') ?>