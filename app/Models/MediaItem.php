<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MediaItem extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name'];

    // ثبت collection به نام 'library'
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('library')
            ->useDisk('media'); // دیسک اختصاصی ما
    }
}
