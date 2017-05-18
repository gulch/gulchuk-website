<?php if (config('debug')): ?>

    <script async src="/assets/js/counters.js"></script>

<?php else: ?>

    <script async src="/build/<?= config('app_version') ?>/c.js"></script>

<?php endif; ?>