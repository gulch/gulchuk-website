<?php $this->layout('backend/template') ?>

<div class="container">

    <div class="ui grid">
        <div class="middle aligned twelve wide column">
            <h1 class="ui header">
                <div class="content">
                    Blog Articles
                    <div class="sub header">List of articles</div>
                </div>
            </h1>
        </div>

        <div class="middle aligned right aligned four wide column">
            <a href="/<?= config('backend_segment') ?>/articles/create" class="ui large labeled icon basic button">
                <i class="add icon"></i>
                Create new
            </a>
        </div>

    </div>

    <div class="ui clearing divider"></div>

    <?php if (sizeof($articles)): ?>
        <div class="ui relaxed items">
            <?php foreach ($articles as $article): ?>
                <div class="item"
                     data-id="<?= $article->id ?>"
                     data-action-element="1"
                >
                    <div class="content">
                        <div class="ui segment raised">

                            <a href="/blog/<?= $this->e($article->slug) ?>"
                               target="_blank"
                               class="ui large header"
                            >
                                <?= $this->e($article->title) ?>
                            </a>

                            <div class="meta">
                                Created: <?= $article->created_at->format('d.m.Y H:i:s') ?>
                            </div>

                            <div class="extra">

                                <?php if(!$article->is_published): ?>
                                <a data-action-name="publish"
                                   data-action="/<?= config('backend_segment') ?>/articles/<?= $article->id ?>/publish"
                                >
                                    <i class="unhide icon"></i>Publish
                                </a>
                                <?php else: ?>
                                <a data-action-name="unpublish"
                                   data-action="/<?= config('backend_segment') ?>/articles/<?= $article->id ?>/unpublish"
                                >
                                    <i class="hide icon"></i>Unpublish
                                </a>
                                <?php endif; ?>

                                <a href="/<?= config('backend_segment') ?>/articles/<?= $article->id ?>/edit">
                                    <i class="edit icon"></i>Edit
                                </a>
                                <a data-popup="1">
                                    <i class="remove circle icon"></i>Remove
                                </a>
                                <div class="ui custom popup">
                                    <div class="ui huge header center aligned">Delete?</div>
                                    <span class="ui negative button"
                                          data-action-name="remove"
                                          data-action-method="POST"
                                          data-action="/<?= config('backend_segment') ?>/articles/<?= $article->id ?>/remove"
                                    >Yes</span>
                                    <span class="ui button">No</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <?php $this->insert('backend/includes/nothing-found') ?>
    <?php endif; ?>

</div>