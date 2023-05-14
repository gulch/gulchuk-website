<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Article;
use App\Models\Tag;
use Psr\Http\Message\ResponseInterface;

final class BlogController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    public function index(): ResponseInterface
    {
        $articles = Article::query()
            ->where('is_published', '1')
            ->orderBy('created_at', 'DESC')
            ->get();

        $data = [
            'articles' => $articles,
            'tags' => $this->getAllTags(),
        ];

        return $this->httpResponse($this->view('frontend/blog/index', $data));
    }

    public function show(): ResponseInterface
    {
        $slug = $this->argument('slug', func_get_arg(1));

        if (!$slug) {
            return $this->abort();
        }

        $article = Article::query()->slug($slug)->first();

        if (!$article) {
            return $this->abort();
        }

        $data = [
            'article' => $article,
            'tags' => $this->getAllTags(),
        ];

        return $this->httpResponse($this->view('frontend/blog/show', $data));
    }

    public function tag(): ResponseInterface
    {
        $slug = $this->argument('slug', func_get_arg(1));

        $tag = Tag::query()
            ->with([
                'articles' => function($query) {
                    $query->where('is_published', '1')
                        ->orderBy('created_at', 'DESC');
                },
            ])
            ->slug($slug)
            ->first();

        if (!$tag) {
            return $this->abort();
        }

        $data = [
            'tag' => $tag,
            'articles' => $tag->articles,
            'tags' => $this->getAllTags(),
        ];

        return $this->httpResponse($this->view('frontend/blog/tag', $data));
    }

    private function getAllTags(): iterable
    {
        return Tag::query()
            ->select(['slug', 'title'])
            ->orderBy('title')
            ->get();
    }
}
