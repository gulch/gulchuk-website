<?php $this->layout('backend/template') ?>

<div class="container">

    <div class="ui grid">
        <div class="middle aligned twelve wide column">
            <div class="ui huge header">
                <div class="content">
                    Tags
                    <div class="sub header">List of tags</div>
                </div>
            </div>
        </div>

        <div class="middle aligned right aligned four wide column">
            <a href="/<?= config('app.backend_segment') ?>/tags/create" class="ui large labeled icon basic button">
                <i class="add icon"></i>
                Create new
            </a>
        </div>

    </div>

    <div class="ui clearing divider"></div>

    <?php if (sizeof($tags)): ?>
        <div class="ui relaxed items">
            <?php foreach ($tags as $tag): ?>
                <div class="item"
                     data-id="<?= $tag->id ?>"
                     data-action-element="1"
                >
                    <div class="content">
                        <div class="ui segment raised">

                            <div class="ui statistic tiny right floated">
                                <div class="value">
                                    <i class="file text outline icon"></i>
                                    <?= $tag->articlesCount() ?>
                                </div>
                            </div>

                            <a href="/blog/tag/<?= $this->e($tag->slug) ?>"
                               target="_blank"
                               class="ui large header"
                            >
                                <?= $this->e($tag->title) ?>
                            </a>

                            <div class="meta">
                                Created: <?= $tag->createdDateInFormat('d.m.Y H:i:s') ?>
                            </div>

                            <div class="extra">

                                <a href="/<?= config('app.backend_segment') ?>/tags/<?= $tag->id ?>/edit">
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
                                          data-action="/<?= config('app.backend_segment') ?>/tags/<?= $tag->id ?>/remove"
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