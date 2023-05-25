<?php

namespace App\Jobs;

use App\Contracts\Job;

final class CreateAvifJob implements Job
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

        $cmd = "avifenc --min 0 --max 63 -a tune=ssim -a sharpness=3 {$source} {$source}.avif";
        
        \exec($cmd . ' > /dev/null');
    }
}
