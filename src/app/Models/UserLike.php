<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    protected $table = 'user_likes';

    protected $fillable = [
        'user_id',
        'article_id',
        'like'
    ];

    protected $attributes = [
        'like' => 'false'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

