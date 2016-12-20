<?php

namespace Gulchuk\Controllers\Backend;

use Gulchuk\Controllers\BaseController;
use Gulchuk\Models\Tag;

class TagsController extends BaseController
{
    public function index()
    {
        $data = [
            'tags' => Tag::all()
        ];

        return $this->response($this->view('backend/tags/index', $data));
    }
}
