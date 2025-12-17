<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostReview extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
        'status'
    ];

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
