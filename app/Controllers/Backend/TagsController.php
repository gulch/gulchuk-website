<?php

namespace Gulchuk\Controllers\Backend;

use Psr\Http\Message\ResponseInterface;
use Gulchuk\Controllers\BaseController;
use Gulchuk\Repositories\TagsRepository;

class TagsController extends BaseController
{
    public function index() : ResponseInterface
    {
        $tags = (new TagsRepository())->getWith(['articles']);

        $data = [
            'tags' => $tags
        ];

        return $this->httpResponse($this->view('backend/tags/index', $data));
    }

    public function remove() : ResponseInterface
    {
        $id = $this->argument(func_get_arg(2), 'id');

        $tagsRepo = new TagsRepository();

        $tag = $tagsRepo->findById($id);

        if (is_null($tag)) {
            return $this->jsonResponse(['message' => 'Record not found.']);
        }

        $tagsRepo->syncArticles($id, []);
        $tagsRepo->delete($id);

        return $this->jsonResponse(['success' => 'OK']);
    }
}
