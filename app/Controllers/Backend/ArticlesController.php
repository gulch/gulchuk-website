<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Jobs\CreateArticleSocialImageJob;
use App\Models\Article;
use App\Models\Tag;
use App\Services\JobService;
use Psr\Http\Message\ResponseInterface;
use Sirius\Validation\Validator;

final class ArticlesController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    public function index(): ResponseInterface
    {
        $articles = Article::query()
            ->with('tags')
            ->orderBy('created_at', 'DESC')
            ->get();

        $data = [
            'articles' => $articles
        ];

        return $this->httpResponse($this->view('backend/articles/index', $data));
    }

    public function create(): ResponseInterface
    {
        $data = [
            'redirectUrl' => $this->request->getServerParams()['HTTP_REFERER'] ?? '/' . \config('app.backend_segment') . '/articles',
            'tags' => Tag::query()->select('id', 'title')->orderBy('title')->get(),
        ];

        return $this->httpResponse($this->view('backend/articles/create', $data));
    }

    public function edit(): ResponseInterface
    {
        $id = $this->argument('id', \func_get_arg(1));

        $article = Article::query()->find($id);

        if (!$article) {
            return $this->abort();
        }

        $data = [
            'article' => $article,
            'article_tags' => $article->tags->pluck('id')->all(),
            'tags' => Tag::query()->select('id', 'title')->orderBy('title')->get(),
            'redirectUrl' => $this->request->getServerParams()['HTTP_REFERER'] ?? '/' . config('app.backend_segment') . '/articles',
        ];

        return $this->httpResponse($this->view('backend/articles/edit', $data));
    }

    public function remove(): ResponseInterface
    {
        $id = $this->argument('id', \func_get_arg(1));

        $article = Article::query()->find($id);

        if (null === $article) {
            return $this->jsonResponse(['message' => 'Record not found']);
        }

        $article->tags()->sync([]);
        
        $article->delete();

        return $this->jsonResponse(['success' => 'OK']);
    }

    public function save(): ResponseInterface
    {
        $redirectUrl = $this->postArgument('redirect_url');
        $id = $this->postArgument('id');

        $data = [
            'title' => $this->postArgument('title'),
            'slug' => $this->postArgument('slug'),
            'content' => $this->postArgument('content'),
            'seo_title' => $this->postArgument('seo_title'),
            'seo_description' => $this->postArgument('seo_description'),
            'seo_keywords' => $this->postArgument('seo_keywords'),
        ];

        // Validation
        $validator = new Validator();
        $validator->add([
            'title:Title' => 'required',
            'slug:Slug' => 'required',
        ]);

        if (false === $validator->validate($data)) {
            return $this->jsonResponse([
                'message' => $this->formatErrorMessages($validator->getMessages()),
            ]);
        }

        // TODO: Filter Input

        if ($id) {
            $article = Article::query()->find($id);

            if (!$article) {
                return $this->jsonResponse([
                    'message' => 'Error! Article not found.'
                ]);
            }

            // update
            if (!$article->update($data)) {
                return $this->jsonResponse([
                    'message' => 'Error! Can not update article. Try again.'
                ]);
            }
        } else {
            // create
            $article = Article::query()->create($data);

            if (!$article->id) {
                return $this->jsonResponse([
                    'message' => 'Error! Can not create new article. Try again.'
                ]);
            }
        }

        // sync article tags
        $article_tags = $this->postArgument('article_tags') ?: [];
        $article->tags()->sync($article_tags);

        return $this->jsonResponse([
            'success' => 'OK',
            'message' => 'Saved',
            'redirect' => $redirectUrl ?? '',
            'id' => $article->id,
        ]);
    }

    public function publish(): ResponseInterface
    {
        return $this->changePublishStatus($this->argument('id', \func_get_arg(1)), 1);
    }

    public function unpublish(): ResponseInterface
    {
        return $this->changePublishStatus($this->argument('id', \func_get_arg(1)), 0);
    }

    public function generateSocialImage(): ResponseInterface
    {
        $id = $this->argument('id', \func_get_arg(1));

        $article = Article::query()->find($id);

        if (null === $article) {
            return $this->jsonResponse(['message' => 'Record not found']);
        }

        $this->executeSocialImageGeneration($article);

        return $this->jsonResponse([
            'success' => 'OK',
            'message' => 'Process executed',
        ]);
    }

    private function changePublishStatus(int $id, int $is_published): ResponseInterface
    {
        $article = Article::query()->find($id);

        if (null === $article) {
            return $this->jsonResponse(['message' => 'Record not found']);
        }

        $is_published = $is_published === 1 ? 1 : 0;

        $article->is_published = $is_published;
        $article->save();

        if ($is_published === 1) {
            // generate social image
            $this->executeSocialImageGeneration($article);
        }

        return $this->jsonResponse([
            'success' => 'OK',
            'message' => $is_published ? 'Published' : 'Unpublished',
        ]);
    }

    private function executeSocialImageGeneration($article): void
    {
        \container(JobService::class)->process([
            'job' => CreateArticleSocialImageJob::class,
            'id' => $article->id,
            'slug' => $article->slug,
            'title' => $article->title,
        ]);
    }
}
