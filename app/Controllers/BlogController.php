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

        /*$a = Article::first()->tags()->get();
        var_dump($a);
            exit();*/

        return $this->response($this->view('frontend.blog.index', $data));
    }

    public function show()
    {
        $slug = $this->argument(func_get_arg(2), 'slug');

        if (!$slug) {
            return $this->abort();
        }

        return $this->response($this->view('frontend.blog.show', compact('slug')));
    }

    public function tag()
    {

    }
}