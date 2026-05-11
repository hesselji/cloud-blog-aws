<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


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
        'categories_id'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION CATEGORY
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'categories_id',
            'id_categories'
        );
    }

    
}