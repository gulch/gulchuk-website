<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Article;
use App\Models\Tag;
use Psr\Http\Message\ResponseInterface;
use samdark\sitemap\Sitemap;

final class SitemapController extends BaseController
{
    public function generate(): ResponseInterface
    {
        $sitemap = new Sitemap(\publicPath() . '/sitemap.xml');

        $date = \time();

        $sitemap->addItem(\config('app.url'), $date, Sitemap::WEEKLY, 1.0);
        $sitemap->addItem(\config('app.url') . '/blog', $date, Sitemap::WEEKLY, 0.7);

        // blog tags
        $tags = Tag::query()->get();
        
        foreach ($tags as $tag) {
            $date = $tag->updated_at ? $tag->updated_at->format('U') : $tag->created_at->format('U');
            $sitemap->addItem(
                \config('app.url') . '/blog/tag/' . $tag->slug,
                $date,
                Sitemap::WEEKLY,
                '0.8'
            );
        }

        // blog articles
        $articles = Article::query()->where('is_published', 1)->get();

        foreach ($articles as $article) {
            $date = $article->updated_at ? $article->updated_at->format('U') : $article->created_at->format('U');
            $sitemap->addItem(
                \config('app.url') . '/blog/' . $article->slug,
                $date,
                Sitemap::ALWAYS,
                '1.0'
            );
        }

        $sitemap->write();

        return $this->redirectResponse(
            \config('app.url') . '/sitemap.xml'
        );
    }
}
