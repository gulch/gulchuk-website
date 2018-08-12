<?php

namespace App\Controllers\Frontend;

use App\Repositories\ArticlesRepository;
use App\Repositories\TagsRepository;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Controllers\BaseController;

class BlogController extends BaseController
{
    public function index(): ResponseInterface
    {
        $data = [
            'articles' => (new ArticlesRepository)->getLatestPublished(),
            'tags' => $this->getAllTags()
        ];

        return $this->httpResponse($this->view('frontend/blog/index', $data));
    }

    public function show(): ResponseInterface
    {
        $slug = $this->argument('slug', \func_get_arg(1));

        if (!$slug) {
            return $this->abort();
        }

        $article = (new ArticlesRepository)->findBySlug($slug);

        if (!$article) {
            return $this->abort();
        }

        $data = [
            'article' => $article,
            'tags' => $this->getAllTags()
        ];

        return $this->httpResponse($this->view('frontend/blog/show', $data));
    }

    public function tag(): ResponseInterface
    {
        $slug = $this->argument('slug', func_get_arg(1));

        $tag = (new TagsRepository)->findBySlug($slug);

        if (!$tag) {
            return $this->abort();
        }

        $data = [
            'tag' => $tag,
            'articles' => (new TagsRepository)->latestPublishedArticles($tag->id),
            'tags' => $this->getAllTags()
        ];

        return $this->httpResponse($this->view('frontend/blog/tag', $data));
    }

    private function getAllTags(): \Traversable
    {
        return (new TagsRepository)->list(['slug', 'title'], 'title');
    }
}
