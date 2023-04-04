<?php

use Cycle\ORM\Schema;
use Cycle\ORM\Mapper\StdMapper;
use Cycle\ORM\Relation;

return [
    'user' => [
        Schema::MAPPER => StdMapper::class,
        Schema::ENTITY => \App\Models\User::class,
        Schema::DATABASE => 'default',
        Schema::TABLE => 'User',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS => [
            'id' => 'id', // property => column
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
            'created_at' => 'created_at',
            'remember_token' => 'remember_token',
        ],
        Schema::TYPECAST => [
            'id' => 'int',
            'created_at' => 'datetime',
        ],
        Schema::RELATIONS => [],
    ],
    'article' => [
        Schema::MAPPER => StdMapper::class,
        Schema::ENTITY => \App\Models\Article::class,
        Schema::DATABASE => 'default',
        Schema::TABLE => 'Article',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS => [
            'id', // property (same column name) OR property => column
            'slug',
            'title',
            'content',
            'is_published',
            'social_image',
            'seo_title',
            'seo_description',
            'seo_keywords',
            'created_at',
            'updated_at',
        ],
        Schema::TYPECAST => [
            'id' => 'int',
            'is_published' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ],
        Schema::RELATIONS => [],
    ],
    'tag' => [
        Schema::MAPPER => StdMapper::class, // default POPO mapper
        Schema::ENTITY => \App\Models\Tag::class,
        Schema::DATABASE => 'default',
        Schema::TABLE => 'Tag',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS => [
            'id', // property (same column name) OR property => column
            'slug',
            'title',
            'content',
            'seo_title',
            'seo_description',
            'seo_keywords',
            'created_at',
            'updated_at',
        ],
        Schema::TYPECAST => [
            'id' => 'int',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ],
        Schema::RELATIONS => [
            'articles' => [
                Relation::TYPE => Relation::HAS_MANY,
                Relation::TARGET => 'article',
                Relation::SCHEMA => [
                    Relation::THROUGH_ENTITY => 'article_tag',
                    Relation::THROUGH_INNER_KEY => 'id__Tag',
                    Relation::THROUGH_OUTER_KEY => 'id__Article',
                   /*  Relation::CASCADE => true, */
                    Relation::INNER_KEY => 'id',
                    Relation::OUTER_KEY => 'id',
                ],
            ],
        ],
    ],
    'article_tag' => [
        Schema::MAPPER => StdMapper::class,
        Schema::ENTITY => \App\Models\ArticleTag::class,
        Schema::DATABASE => 'default',
        Schema::TABLE => 'Article_Tag',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS => [
            'id', // property (same column name) OR property => column
            'id__Article',
            'id__Tag',
        ],
        Schema::TYPECAST => [
            'id' => 'int',
            'id__Article' => 'int',
            'id__Tag' => 'int',
        ],
        Schema::RELATIONS => [],
    ],
];
