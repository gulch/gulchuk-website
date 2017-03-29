<?php namespace Gulchuk\Controllers\Frontend;

use Gulchuk\Controllers\BaseController;
use Gulchuk\Repositories\ArticlesRepository;
use Gulchuk\Repositories\TagsRepository;
use Psr\Http\Message\ResponseInterface;
use samdark\sitemap\Sitemap;

class SitemapController extends BaseController
{
    public function generate(): ResponseInterface
    {
        $sitemap = new Sitemap($_SERVER['DOCUMENT_ROOT'] . '/sitemap.xml');

        $date = time();

        $sitemap->addItem(config('app_url'), $date, Sitemap::WEEKLY, 1.0);
        $sitemap->addItem(config('app_url') . '/blog', $date, Sitemap::WEEKLY, 0.7);

        // blog tags
        $tags = (new TagsRepository())->all();
        foreach ($tags as $tag) {
            $date = $tag->updated_at ? $tag->updated_at->getTimestamp() : $tag->created_at->getTimestamp();
            $sitemap->addItem(
                config('app_url') . '/blog/tag/' . $tag->slug,
                $date,
                Sitemap::WEEKLY,
                '0.8'
            );
        }

        // blog articles
        $articles = (new ArticlesRepository())->all();
        foreach ($articles as $article) {
            $date = $article->updated_at ? $article->updated_at->getTimestamp() : $article->created_at->getTimestamp();
            $sitemap->addItem(
                config('app_url') . '/blog/' . $article->slug,
                $date,
                Sitemap::ALWAYS,
                '0.9'
            );
        }

        $sitemap->write();

        return $this->redirectResponse(config('app_url') . '/sitemap.xml');
    }
}