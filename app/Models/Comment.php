<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Comment extends Model
{
    protected $table = 'comments';

    protected $primaryKey = 'id_comments';

    protected $fillable = [
        'posts_id',
        'name',
        'email',
        'comment'
    ];

    public $timestamps = false;

    /*
    |--------------------------------------------------------------------------
    | RELATION POST
    |--------------------------------------------------------------------------
    */

    public function post()
    {
        return $this->belongsTo(
            Post::class,
            'posts_id',
            'id_posts'
        );
    }
}