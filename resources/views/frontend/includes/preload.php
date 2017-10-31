<?php if (config('app.debug') === false): ?>

    <link rel="preload" href="/build/<?= config('app.version') ?>/fo.css" type="text/css" as="style">
    <link rel="preload" href="/build/<?= config('app.version') ?>/f.css" type="text/css" as="style">

<?php endif; ?>