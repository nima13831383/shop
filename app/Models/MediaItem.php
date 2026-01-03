<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;

class MediaItem extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title'];

    /**
     * کالکشن‌ها
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'video/mp4',       // اضافه کردن فیلم
                'video/webm',
                'video/ogg'
            ])->useDisk('media_public'); // public/media
    }

    /**
     * thumbnail
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        if ($media && str_starts_with($media->mime_type, 'image')) {
            $this
                ->addMediaConversion('thumb')
                ->fit(Fit::Contain, 150, 150)
                ->nonQueued();
        }
    }
}
