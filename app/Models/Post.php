<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'body',
        'ttr',
        'description',
        'image',
        'views',
        'meta_keywords',
        'meta_description',
        'published',
        'user_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* categories */
    public function categories()
    {
        return $this->belongsToMany(PostCategory::class, 'post_category', 'post_id', 'category_id');
    }


    /* reviews */
    public function reviews()
    {
        return $this->hasMany(PostReview::class);
    }


    public function getSmartDateAttribute()
    {
        $date = $this->created_at;
        $now  = now();

        if ($date->diffInMinutes($now) < 60) {
            $m = floor($date->diffInMinutes($now));
            return $m . ' minute' . ($m !== 1 ? 's' : '') . ' ago';
        }

        if ($date->diffInHours($now) < 24) {
            $h = floor($date->diffInHours($now));
            return $h . ' hour' . ($h !== 1 ? 's' : '') . ' ago';
        }

        if ($date->diffInDays($now) < 7) {
            $d = floor($date->diffInDays($now));
            return $d . ' day' . ($d !== 1 ? 's' : '') . ' ago';
        }

        if ($date->diffInWeeks($now) < 4) {
            $w = floor($date->diffInWeeks($now));
            return $w . ' week' . ($w !== 1 ? 's' : '') . ' ago';
        }

        if ($date->diffInMonths($now) < 12) {
            $m = floor($date->diffInMonths($now));
            return $m . ' month' . ($m !== 1 ? 's' : '') . ' ago';
        }

        return $date->format('M d, Y');
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png']);
    }
}
