<?php

namespace Gulchuk\Controllers;

use Gulchuk\Models\Article;

class BlogController extends BaseController
{
    public function index()
    {
        $data = [
            'articles' => Article::all()
        ];

        $a = Article::first()->tags()->get();
        var_dump($a);
            exit();

        return $this->response($this->view('frontend.blog.index', $data));
    }

    public function show()
    {
        $slug = null;
        $args = func_get_arg(2);
        if ($args) {
            $slug = isset($args['slug']) ? $args['slug'] : null;
        }
        if (!$slug) {
            
        }

        return $this->show404();

        return $this->response($this->view('frontend.blog.show', compact('slug')));
    }
}