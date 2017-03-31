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

        $crop = $options['crop'] ?? false;
        $width = $options['width'] ?? null;
        $height = $options['height'] ?? null;
        $quality = $options['quality'] ?? 80;

        if ($width && $height) {
            if (($image->height() / $image->width()) < ($height / $width)) {
                $image->resize(null, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $image->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            if ($crop) {
                $image->crop($width, $height);
            }
        } else {
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        
        // remove all image metadata
        $image->getCore()->stripImage();
        
        // image will be processed as a progressive JPEG
        $image->interlace(true);

        // save processed image
        $image->save($result, $quality);

        // free resources
        $image->destroy();

        // check if processed file exists
        return file_exists($result);
    }
}