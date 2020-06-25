<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $path = $request->file('image')->store('public/article');
        $path = str_replace('public', '', $path); //FIXME: もっと良い書き方がありそう

        return asset('/storage'. $path);
    }
}
