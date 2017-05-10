<?php if(config('debug')): ?>
    <script src="/assets/js/icons-loader.js" async></script>
<?php else: ?>
    <script src="<?= elixir('assets/processed/ilo.js') ?>" async></script>
<?php endif; ?>