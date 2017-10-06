<?php

namespace App\Jobs;

use Bernard\Message;

class CreateWebpJob
{
    public static function handle(Message $message): void
    {
        $source = $message->source ?? null;

        if (!$source) {
            error_log("Source parameter not isset.");
        }

        if (!file_exists($source)) {
            error_log("File {$source} not exists.");
        }

        $cmd = "cwebp -quiet -alpha_method 1 -alpha_filter best -m 6 -mt {$source} -o {$source}.webp";
        exec($cmd . ' > /dev/null &');
    }
}