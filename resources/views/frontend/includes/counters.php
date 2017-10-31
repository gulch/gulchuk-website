<?php if (config('app.debug')): ?>

    <script async src="/assets/js/counters.js"></script>

<?php else: ?>

    <script async src="/build/<?= config('app.version') ?>/c.js"></script>

<?php endif; ?>