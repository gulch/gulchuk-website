<?php

namespace App\Jobs;

use App\Contracts\Job;

class CreateWebpJob implements Job
{
    public function handle(array $options): void
    {
        $source = $options['source'] ?? null;

        if (!$source) {
            \error_log("Source parameter not isset.");
        }

        if (!file_exists($source)) {
            \error_log("File {$source} not exists.");
        }

        $cmd = "cwebp -quiet -alpha_method 1 -alpha_filter best -m 6 -mt {$source} -o {$source}.tmp";
        \exec($cmd . ' > /dev/null');
        \rename($source . '.tmp', $source . '.webp');
    }
}
