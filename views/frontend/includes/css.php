<link rel="stylesheet" href="<?= config('app.build_folder_path') . config('app.version') ?>/f.css">

<?php if (isset($styles)): ?>
    <?php foreach ($styles as $style): ?>
        <link rel="stylesheet" href="<?= $style ?>">
    <?php endforeach; ?>
<?php endif; ?>
