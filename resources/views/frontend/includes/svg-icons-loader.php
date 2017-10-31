<?php if(config('app.debug')): ?>

    <script async src="/assets/js/icons-loader.js"></script>

<?php else: ?>

    <script async src="/build/<?= config('app.version') ?>/ilo.js"></script>

<?php endif; ?>