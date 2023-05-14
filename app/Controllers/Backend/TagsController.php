<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\Tag;
use Psr\Http\Message\ResponseInterface;
use Sirius\Validation\Validator;

final class TagsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): ResponseInterface
    {
        $tags = Tag::query()
            ->with('articles')
            ->orderBy('created_at', 'DESC')
            ->get();

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

        $tag = Tag::query()->find($id);

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

        $tag = Tag::query()->find($id);

        if (!$tag) {
            return $this->jsonResponse(['message' => 'Record not found.']);
        }

        $tag->articles()->sync([]);
        
        $tag->delete($id);

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
            $tag = Tag::query()->find($id);
            // update
            if (!$tag->update($id, $data)) {
                return $this->jsonResponse([
                    'message' => 'Error! Can not update tag. Try again.'
                ]);
            }
        } else {
            // create
            $tag = Tag::query()->create($data);
            
            if (!$tag->id) {
                return $this->jsonResponse([
                    'message' => 'Error! Can not create new tag. Try again.'
                ]);
            }
        }

        return $this->jsonResponse([
            'success' => 'OK',
            'message' => 'Saved',
            'redirect' => $redirectUrl ?? '',
            'id' => $tag->id,
        ]);
    }
}
