<?php

namespace Gulchuk\Controllers\Backend;

use Psr\Http\Message\ResponseInterface;
use Gulchuk\Controllers\BaseController;
use Gulchuk\Models\Tag;

class TagsController extends BaseController
{
    public function index() : ResponseInterface
    {
        $tags = Tag::with('articles')->orderBy('title')->get();

        $data = [
            'tags' => $tags
        ];

        return $this->httpResponse($this->view('backend/tags/index', $data));
    }

    public function remove() : ResponseInterface
    {
        $id = $this->argument(func_get_arg(2), 'id');

        $tag = Tag::find($id);

        if (is_null($tag)) {
            return $this->jsonResponse(['message' => 'Record not found.']);
        }

        $tag->articles()->sync([]);
        $tag->delete();

        return $this->jsonResponse(['success' => 'OK']);
    }
}
