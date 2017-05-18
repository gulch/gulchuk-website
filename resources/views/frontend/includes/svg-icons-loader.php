<?php if(config('debug')): ?>

    <script async src="/assets/js/icons-loader.js"></script>

<?php else: ?>

    <script async src="/build/<?= config('app_version') ?>/ilo.js"></script>

<?php endif; ?>