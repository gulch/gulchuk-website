<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Repositories\TagsRepository;
use Psr\Http\Message\ResponseInterface;
use Sirius\Validation\Validator;

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
}
