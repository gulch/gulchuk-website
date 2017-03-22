<?php namespace Gulchuk\Services;

use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class ImageService
{
    public function process(string $source, string $result, array $options): bool
    {
        $im = new ImageManager(['driver' => 'imagick']);
        /** @var Image $image */
        $image = $im->make($source);

        if (!$image) {
            return false;
        }

        // TODO: process image
    }
}