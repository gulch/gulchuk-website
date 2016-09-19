<?php if(isset($message)): ?>
    <div class="ui icon warning message">
        <i class="warning sign icon"></i>
        <div class="content">
            <?= $this->e($message) ?>
        </div>
    </div>
<?php endif ?>