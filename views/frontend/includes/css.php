<link rel="stylesheet" href="<?= g_asset('f.css') ?>">

<?php if (isset($styles)): ?>
    <?php foreach ($styles as $style): ?>
        <link rel="stylesheet" href="<?= $style ?>">
    <?php endforeach; ?>
<?php endif; ?>
