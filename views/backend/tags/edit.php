<?php /** @var $this \League\Plates\Template\Template */ ?>
<?php $this->layout('backend/template') ?>

<div class="container">

    <div class="ui grid">
        <div class="middle aligned twelve wide column">
            <h1 class="ui header">
                <div class="content">
                    Edit tag &laquo;<?= $this->e($tag->title) ?>&raquo;
                    <div class="sub header">Edit tag form</div>
                </div>
            </h1>
        </div>

    </div>

    <div class="ui clearing divider"></div>

    <?php $this->insert('backend/tags/includes/form', [
        'tag' => $tag,
        'redirectUrl' => $redirectUrl
    ]) ?>

</div>