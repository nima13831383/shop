<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    /* parent category */
    public function parent()
    {
        return $this->belongsTo(PostCategory::class, 'parent_id');
    }

    /* sub categories */
    public function children()
    {
        return $this->hasMany(PostCategory::class, 'parent_id');
    }

    /* Posts in category */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
    }
}
