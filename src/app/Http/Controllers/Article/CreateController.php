<?php

namespace App\Http\Controllers\Article;

use App\Http\Requests\Article\CreateRequest;
use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function showForm()
    {
        return Inertia::render('Article/Form');
    }

    public function store(CreateRequest $request)
    {
        return Article::create(['user_id' => Auth::id()] + $request->all());
    }
}
