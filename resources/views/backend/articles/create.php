<?php $this->layout('backend/template') ?>

<div class="container">

    <div class="ui grid">
        <div class="middle aligned twelve wide column">
            <h1 class="ui header">
                <div class="content">
                    Create article
                    <div class="sub header">Add new blog article item</div>
                </div>
            </h1>
        </div>

    </div>

    <div class="ui clearing divider"></div>

    <?php $this->insert('backend/articles/includes/form', ['redirectUrl' => $redirectUrl]) ?>

</div>