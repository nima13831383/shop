<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostReview extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'status',
        'name',
        'email',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(PostReview::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(PostReview::class, 'parent_id')->where('status','approved')->with('children');
    }
}
