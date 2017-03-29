<!--  Loader CSS  -->
<style>
    <?= config('debug') ?
        file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/css/loader.css') :
        file_get_contents($_SERVER['DOCUMENT_ROOT'] . elixir('assets/processed/lo.css')) ?>
</style>