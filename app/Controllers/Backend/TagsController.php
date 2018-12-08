<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Repositories\TagsRepository;
use Psr\Http\Message\ResponseInterface;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\InputFilter\InputFilterInterface;

class TagsController extends BaseController
{
    private $tagsRepository;

    public function __construct(TagsRepository $repository)
    {
        parent::__construct();
        $this->tagsRepository = $repository;
    }

    public function index(): ResponseInterface
    {
        $tags = $this->tagsRepository->getWith(['articles'], 'created_at', 'desc');

        $data = [
            'tags' => $tags
        ];

        return $this->httpResponse($this->view('backend/tags/index', $data));
    }

    public function create(): ResponseInterface
    {
        $data = [
            'redirectUrl' => $this->request->getServerParams()['HTTP_REFERER'] ?? '/' . config('app.backend_segment') . '/tags',
        ];

        return $this->httpResponse($this->view('backend/tags/create', $data));
    }

    public function edit(): ResponseInterface
    {
        $id = $this->argument('id', func_get_arg(1));

        $tag = $this->tagsRepository->findById($id);

        if (!$tag) {
            return $this->abort();
        }

        $data = [
            'tag' => $tag,
            'redirectUrl' => $this->request->getServerParams()['HTTP_REFERER'] ?? '/' . config('app.backend_segment') . '/tags',
        ];

        return $this->httpResponse($this->view('backend/tags/edit', $data));
    }

    public function remove(): ResponseInterface
    {
        $id = $this->argument('id', \func_get_arg(1));

        $tag = $this->tagsRepository->findById($id);

        if (!$tag) {
            return $this->jsonResponse(['message' => 'Record not found.']);
        }

        $this->tagsRepository->syncArticles($id, []);
        $this->tagsRepository->delete($id);

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

        $inputFilter = $this->saveTagInputFilter();
        $inputFilter->setData($data);

        if (!$inputFilter->isValid()) {
            return $this->jsonResponse([
                'message' => $this->formatErrorMessages($inputFilter),
            ]);
        }

        if ($id) {
            // update
            if (!$this->tagsRepository->update($id, $inputFilter->getValues())) {
                return $this->jsonResponse([
                    'message' => 'Error! Can not update tag. Try again.'
                ]);
            }
        } else {
            // create
            if (!$id = $this->tagsRepository->create($inputFilter->getValues())) {
                return $this->jsonResponse([
                    'message' => 'Error! Can not create new tag. Try again.'
                ]);
            }
        }

        return $this->jsonResponse([
            'success' => 'OK',
            'message' => 'Saved',
            'redirect' => $redirectUrl ?? '',
            'id' => $id ?? '',
        ]);
    }

    private function saveTagInputFilter(): InputFilterInterface
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
