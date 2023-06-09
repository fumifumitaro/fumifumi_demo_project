<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function user_bookmarks(){
        return $this->hasMany(UserBookmark::class);
    }

    public function user_likes(){
        return $this->hasMany(UserLike::class);
    }
}
