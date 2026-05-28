<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'id_posts';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'status',
        'categories_id',
    ];

    protected $appends = [
        'image_url',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'categories_id',
            'id_categories'
        );
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'images/')) {
            /** @var FilesystemAdapter $disk */
            $disk = Storage::disk('s3');

            return $disk->temporaryUrl(
                $this->image,
                now()->addMinutes(60)
            );
        }

        return asset('images/' . $this->image);
    }
}