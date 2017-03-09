<?php

namespace Gulchuk\Repositories;

use Gulchuk\Models\Article;

class ArticlesRepository extends BaseRepository
{
    public function __construct()
    {
        $this->modelName = Article::class;
    }
}