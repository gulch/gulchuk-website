<?php

namespace App\Jobs;

use App\Contracts\Job;
use App\Repositories\ArticlesRepository;
use Intervention\Image\ImageManager;
use Intervention\Image\Image;

class CreateArticleSocialImageJob implements Job
{
    public function handle(array $options): void
    {
        $title = $options['title'] ?? null;
        $slug = $options['slug'] ?? null;
        $id = $options['id'] ?? null;

        if (!$title || !$slug || !$id) {
            \error_log('Title or Slug not isset');
            return;
        }

        $manager = new ImageManager(['driver' => 'imagick']);

        /** @var Image $image */
        // Facebook Recommends 1200x630
        $image = $manager->canvas(1200, 630, '#e4ff6e');

        // insert logo
        $logo = $manager->make(\publicPath() . '/assets/img/logo-100x100.png');
        $logo->rotate(35);
        $logo->opacity(5);

        // create pattern
        $image->fill($logo);

        // title
        $titleCanvas = $manager->canvas($image->width(), $image->height());
        $string = \wordwrap(strtoupper($title), 30, "|");
        //create array of lines
        $strings = \explode("|", $string);
        $i = 20; //top position of string
        //for each line added
        foreach ($strings as $string) {
            $titleCanvas->text($string, 0, $i, function ($font) {
                $font->file(\publicPath() . '/assets/font/source-sans-pro/bold.otf');
                $font->size(72);
                $font->color('#4a4a4a');
                $font->valign('top');
            });
            $i = $i + 80;
        }
        $titleHeight = $i + 20 - 8;
        $image->insert($titleCanvas, 'top-left', 30, \intval($image->height() / 2 - $titleHeight / 2));

        $file = \getUploadFilePath(\config('app.images_path_social')) . '/' . $slug . '.png';
        $image->save($file);

        // save to DB
        \container(ArticlesRepository::class)->update($id, [
            'social_image' => \str_replace(\publicPath(), '', $file)
        ]);

        // optimize image by pngquant tool
        \exec('pngquant -f '.$file.' --output '.$file.' > /dev/null &');
    }
}
