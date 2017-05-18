<?php if (config('debug')): ?>

    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/css/fonts.css">

    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/reset.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/site.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/container.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/grid.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/segment.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/image.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/menu.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/header.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/divider.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/list.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/breadcrumb.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/vendor/semantic/2.2.6/components/icon.css">

    <link rel="stylesheet" type="text/css" property="stylesheet" href="/assets/css/frontend.css">

<?php else: ?>

    <link rel="stylesheet" type="text/css" property="stylesheet" href="/build/<?= config('app_version') ?>/fo.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="/build/<?= config('app_version') ?>/f.css">

<?php endif; ?>

<?php if (isset($styles)): ?>
    <?php foreach ($styles as $style): ?>
        <link rel="stylesheet" type="text/css" property="stylesheet" href="<?= $style ?>">
    <?php endforeach; ?>
<?php endif; ?>