<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Tag extends Model
{
    protected $table = 'Tag';

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

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'Article_Tag', 'id__Tag', 'id__Article');
    }

}
