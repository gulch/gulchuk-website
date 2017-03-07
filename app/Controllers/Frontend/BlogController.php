<?php

namespace Gulchuk\Controllers\Frontend;

use Psr\Http\Message\ResponseInterface;
use Gulchuk\Controllers\BaseController;
use Gulchuk\Models\Article;
use Gulchuk\Models\Tag;

class BlogController extends BaseController
{
    public function index() : ResponseInterface
    {
        $data = [
            'articles' => Article::all(),
            'tags' => $this->getAllTags()
        ];

        return $this->httpResponse($this->view('frontend/blog/index', $data));
    }

    public function show() : ResponseInterface
    {
        $slug = $this->argument('slug', func_get_arg(2));

        if (!$slug) {
            return $this->abort();
        }

        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            return $this->abort();
        }

        $data = [
            'article' => $article,
            'tags' => $this->getAllTags()
        ];

        return $this->httpResponse($this->view('frontend/blog/show', $data));
    }

    public function tag() : ResponseInterface
    {
        $slug = $this->argument('slug', func_get_arg(2));

        $tag = Tag::where('slug', $slug)->first();

        if (!$tag) {
            return $this->abort();
        }

        $data = [
            'tag' => $tag,
            'articles' => $tag->articles,
            'tags' => $this->getAllTags()
        ];

        return $this->httpResponse($this->view('frontend/blog/tag', $data));
    }

    private function getAllTags() : \Traversable
    {
        return Tag::select('slug','title')->orderBy('title', 'asc')->get();
    }
}