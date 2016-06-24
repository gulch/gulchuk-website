<?php

namespace Gulchuk\Controllers;

class BlogController extends BaseController
{
    public function index()
    {
        $this->response->getBody()->write($this->blade->render('frontend.blog.index'));
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

        $this->response->getBody()->write($this->blade->render('frontend.blog.show', compact('slug')));
    }
}