<?php if (isset($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <?php if (is_array($script)): ?>
            <script <?= $script['load'] ?> src="<?= $script['src'] ?>"></script>
        <?php else: ?>
            <script src="<?= $script ?>"></script>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>