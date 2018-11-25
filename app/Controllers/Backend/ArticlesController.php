<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Repositories\ArticlesRepository;
use App\Repositories\TagsRepository;
use Psr\Http\Message\ResponseInterface;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilterInterface;

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
        $articles = $this->articlesRepository
            ->getWith(['tags'], 'created_at', 'desc');

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
            'article_tags' => $this->articlesRepository->articleTagsIds($id),
        ];

        return $this->httpResponse($this->view('backend/articles/edit', $data));
    }

    public function remove(): ResponseInterface
    {
        $id = $this->argument('id', \func_get_arg(1));

        $article = $this->articlesRepository->findById($id);

        if (null === $article) {
            return $this->jsonResponse(['message' => 'Record not found.']);
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

        $inputFilter = $this->saveArticleInputFilter();
        $inputFilter->setData($data);

        if (!$inputFilter->isValid()) {
            return $this->jsonResponse([
                'message' => $this->formatErrorMessages($inputFilter),
            ]);
        }

        if ($id) {
            // update
            if (!$this->articlesRepository->update($id, $inputFilter->getValues())) {
                return $this->jsonResponse([
                    'message' => 'Error! Can not update article. Try again.'
                ]);
            }
        } else {
            // create
            if (!$id = $this->articlesRepository->create($inputFilter->getValues())) {
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
            return $this->jsonResponse(['message' => 'Record not found.']);
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
            return $this->jsonResponse(['message' => 'Record not found.']);
        }

        $article->is_published = $is_published;
        $article->save();

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
        \container('job-service')->process([
            'job' => 'CreateArticleSocialImage',
            'id' => $article->id,
            'slug' => $article->slug,
            'title' => $article->title,
        ]);
    }

    private function saveArticleInputFilter(): InputFilterInterface
    {
        $factory = new InputFilterFactory();
        $inputFilter = $factory->createInputFilter([
            'title' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    ['name' => 'NotEmpty'],
                ],
            ],
            'slug' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                ],
                'validators' => [
                    ['name' => 'NotEmpty'],
                ],
            ],
            'content' => [
                'required' => false
            ],
            'seo_title' => [
                'required' => false,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                ],
            ],
            'seo_description' => [
                'required' => false,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                ],
            ],
            'seo_keywords' => [
                'required' => false,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                ],
            ],
        ]);

        return $inputFilter;
    }
}
