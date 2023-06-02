<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBookmark extends Model
{
    protected $table = 'user_bookmarks';

    protected $fillable = [
        'user_id',
        'article_id',
        'bookmark'
    ];

    protected $attributes = [
        'bookmark' => 'false'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
