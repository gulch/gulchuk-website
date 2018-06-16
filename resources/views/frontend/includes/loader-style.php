<?php /* Loader CSS */ ?>
<style>
    <?php
        echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/build/' . config('app.version') . '/lo.css');
    ?>
</style>