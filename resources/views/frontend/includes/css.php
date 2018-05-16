<?php if (config('app.debug')): ?>

    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/css/fonts.css">

    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/reset.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/site.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/container.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/grid.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/segment.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/image.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/menu.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/header.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/divider.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/list.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/breadcrumb.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.3.1/components/icon.css">

    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/css/frontend.css">

<?php else: ?>

    <link rel="stylesheet" type="text/css" property="stylesheet" href="/build/<?= config('app.version') ?>/fo.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/build/<?= config('app.version') ?>/f.css">

<?php endif; ?>

<?php if (isset($styles)): ?>
    <?php foreach ($styles as $style): ?>
        <link rel="stylesheet" type="text/css" property="stylesheet" href="<?= $style ?>">
    <?php endforeach; ?>
<?php endif; ?>