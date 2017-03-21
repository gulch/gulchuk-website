<h3 class="ui top attached header">
    <i class="announcement icon"></i>
    SEO
</h3>
<div class="ui bottom attached segment">
    <div class="field">
        <label for="seo_title">
            Title
            <span class="ui label counter">---</span>
        </label>
        <input type="text" name="seo_title" value="<?= $item ? $item->seo_title : '' ?>">
    </div>

    <div class="ui hidden divider"></div>

    <div class="two fields">
        <div class="field">
            <label for="seo_description">
                Description
                <span class="ui label counter">---</span>
            </label>
            <textarea name="seo_description" rows="4"><?= $item ? $item->seo_description : '' ?></textarea>
        </div>
        <div class="field">
            <label for="seo_keywords">
                Keywords
                <span class="ui label counter">---</span>
            </label>
            <textarea name="seo_keywords" rows="4"><?= $item ? $item->seo_keywords : '' ?></textarea>
        </div>
    </div>
</div>