<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Repositories\ArticlesRepository;
use Psr\Http\Message\ResponseInterface;
use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;

class FeedController extends BaseController
{
    public function generate(): ResponseInterface
    {
        $date = \time();

        $feed = new Feed;

        $channel = (new Channel)
            ->title('Gulchuk')
            ->description('Gulchuk Personal Website')
            ->url(\config('app.url'))
            ->language('en-US')
            ->copyright(\date('Y') . ' GULCHUK.COM')
            ->pubDate($date)
            ->lastBuildDate($date)
            ->ttl(60)
            ->appendTo($feed);

        // blog articles
        $articles = (new ArticlesRepository)->getWithOptions('created_at', 'desc', 20);
        foreach ($articles as $article) {
            $date = $article->updated_at ? $article->updated_at->getTimestamp() : $article->created_at->getTimestamp();

            (new Item)
                ->title($article->title)
                ->description($article->seo_description)
                ->url(\config('app.url') . '/blog/' . $article->slug)
                ->pubDate($date)
                ->guid(\config('app.url') . '/blog/' . $article->slug, true)
                ->preferCdata(true)
                ->appendTo($channel);
        }

        $this->response->getBody()->write($feed->render());

        return $this->response->withHeader('Content-Type', 'application/rss+xml; charset=utf-8');
    }
}
