<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id_categories';

    protected $fillable = [
        'name',
        'slug'
    ];

    public $timestamps = false;

    /*
    |--------------------------------------------------------------------------
    | RELATION POSTS
    |--------------------------------------------------------------------------
    */

    public function posts()
    {
        return $this->hasMany(
            Post::class,
            'categories_id',
            'id_categories'
        );
    }
}