<?php /* Loader CSS */ ?>
<style>
    <?php
        if (config('debug')) {

            echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/css/loader.css');

        } else {

            echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/build/' . config('app_version') . '/lo.css');

        }
    ?>
</style>