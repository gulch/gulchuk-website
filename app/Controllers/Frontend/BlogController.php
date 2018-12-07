<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Repositories\ArticlesRepository;
use App\Repositories\TagsRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BlogController extends BaseController
{
    private $articlesRepository;
    private $tagsRepository;

    public function __construct(
        ArticlesRepository $articlesRepository,
        TagsRepository $tagsRepository
    ) {
        parent::__construct();
        $this->articlesRepository = $articlesRepository;
        $this->tagsRepository = $tagsRepository;
    }

    public function index(): ResponseInterface
    {
        $data = [
            'articles' => $this->articlesRepository->getLatestPublished(),
            'tags' => $this->getAllTags(),
        ];

        return $this->httpResponse($this->view('frontend/blog/index', $data));
    }

    public function show(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $slug = $args['slug'] ?? null;

        if (!$slug) {
            return $this->abort();
        }

        $article = $this->articlesRepository->findBySlug($slug);

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

        $tag = $this->tagsRepository->findBySlug($slug);

        if (!$tag) {
            return $this->abort();
        }

        $data = [
            'tag' => $tag,
            'articles' => $this->tagsRepository->latestPublishedArticles($tag->id),
            'tags' => $this->getAllTags()
        ];

        return $this->httpResponse($this->view('frontend/blog/tag', $data));
    }

    private function getAllTags(): iterable
    {
        return $this->tagsRepository->list(['slug', 'title'], 'title');
    }
}
