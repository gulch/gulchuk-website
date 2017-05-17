<?php if (config('debug')): ?>

    <script async src="/assets/js/counters.js"></script>

<?php else: ?>

    <script async src="<?= elixir('assets/processed/c.js') ?>"></script>

<?php endif; ?>