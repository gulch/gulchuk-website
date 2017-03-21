<?php

namespace Gulchuk\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Tag extends Eloquent
{
    protected $table = 'Tag';

    protected $fillable = [
        'title',
        'slug',
        'content',

        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    /* -------------- Scopes -------------- */

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /* ------------- Relations ------------ */

    public function articles()
    {
        return $this->belongsToMany('Gulchuk\Models\Article', 'Article_Tag', 'id__Tag', 'id__Article');
    }

    /* ----- Custom Functions ----- */

    public function articlesCount()
    {
        return $this->articles->count();
    }
}
