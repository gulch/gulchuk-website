<link rel="stylesheet" type="text/css" property="stylesheet" href="/build/<?= config('app.version') ?>/fo.css">
<link rel="stylesheet" type="text/css" property="stylesheet" href="/build/<?= config('app.version') ?>/f.css">

<?php if (isset($styles)): ?>
    <?php foreach ($styles as $style): ?>
        <link rel="stylesheet" type="text/css" property="stylesheet" href="<?= $style ?>">
    <?php endforeach; ?>
<?php endif; ?>