<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineCache extends Model
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

    public function timeline()
    {

    }

    public function member()
    {

    }
}
