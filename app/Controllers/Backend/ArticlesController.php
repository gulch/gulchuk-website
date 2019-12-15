<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Jobs\CreateArticleSocialImageJob;
use App\Repositories\ArticlesRepository;
use App\Repositories\TagsRepository;
use App\Services\JobService;
use Psr\Http\Message\ResponseInterface;
use Sirius\Validation\Validator;

class ArticlesController extends BaseController
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
        $articles = $this->articlesRepository->getWith(['tags'], 'created_at', 'desc');

        $data = [
            'articles' => $articles
        ];

        return $this->httpResponse($this->view('backend/articles/index', $data));
    }

    public function create(): ResponseInterface
    {
        $data = [
            'redirectUrl' => $this->request->getServerParams()['HTTP_REFERER'] ?? '/' . \config('app.backend_segment') . '/articles',
            'tags' => $this->tagsRepository->list(['id', 'title'], 'title'),
        ];

        return $this->httpResponse($this->view('backend/articles/create', $data));
    }

    public function edit(): ResponseInterface
    {
        $id = $this->argument('id', \func_get_arg(1));

        $article = $this->articlesRepository->findById($id);

        if (!$article) {
            return $this->abort();
        }

        $data = [
            'article' => $article,
            'redirectUrl' => $this->request->getServerParams()['HTTP_REFERER'] ?? '/' . config('app.backend_segment') . '/articles',
            'tags' => $this->tagsRepository->list(['id', 'title'], 'title'),
            'article_tags' => $this->articlesRepository->articleTagsIdsArray($id),
        ];

        return $this->httpResponse($this->view('backend/articles/edit', $data));
    }

    public function remove(): ResponseInterface
    {
        $id = $this->argument('id', \func_get_arg(1));

        $article = $this->articlesRepository->findById($id);

        if (null === $article) {
            return $this->jsonResponse(['message' => 'Record not found']);
        }

        $this->articlesRepository->syncTags($id, []);
        $this->articlesRepository->delete($id);

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

        if (!$validator->validate($data)) {
            return $this->jsonResponse([
                'message' => $this->formatErrorMessages($validator->getMessages()),
            ]);
        }

        // TODO: Filter Input

        if ($id) {
            // update
            if (!$this->articlesRepository->update($id, $inputFilter->getValues())) {
                return $this->jsonResponse([
                    'message' => 'Error! Can not update article. Try again.'
                ]);
            }
        } else {
            // create
            $id = $this->articlesRepository->create($inputFilter->getValues());

            if (0 === $id) {
                return $this->jsonResponse([
                    'message' => 'Error! Can not create new article. Try again.'
                ]);
            }
        }

        // sync article tags
        $article_tags = $this->postArgument('article_tags') ?: [];
        $this->articlesRepository->syncTags($id, $article_tags);

        return $this->jsonResponse([
            'success' => 'OK',
            'message' => 'Saved',
            'redirect' => $redirectUrl ?? '',
            'id' => $id ?? '',
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

        $article = $this->articlesRepository->findById($id);

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
        $article = $this->articlesRepository->findById($id);

        if (null === $article) {
            return $this->jsonResponse(['message' => 'Record not found']);
        }

        $this->articlesRepository->update($id, ['is_published' => $is_published]);

        if ($is_published) {
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
