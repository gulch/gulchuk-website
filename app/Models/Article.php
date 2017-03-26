<?php

namespace Gulchuk\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Eloquent
{
    protected $table = 'Article';

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

    public function image()
    {
        return $this->belongsTo('Gulchuk\Models\Image','id__Image');
    }

    public function tags()
    {
        return $this->belongsToMany('Gulchuk\Models\Tag', 'Article_Tag', 'id__Article', 'id__Tag');
    }
}
