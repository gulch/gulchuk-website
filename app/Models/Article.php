<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'Article';

    protected $fillable = [
        'slug',
        'title',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    /** Scopes */

    public function scopeSlug(Builder $query, string $slug): void
    {
        $query->where('slug', $slug);
    }

    /* Relations */

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'Article_Tag', 'id__Article', 'id__Tag');
    }
}
