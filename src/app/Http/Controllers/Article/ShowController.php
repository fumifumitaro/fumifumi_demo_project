<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Transformer\ArticleTransformer;
use Illuminate\Http\Request;

use Inertia\Inertia;

class ShowController extends Controller
{
    public function __invoke(Article $article)
    {
        $articleTransformer = new ArticleTransformer();

        return Inertia::render('Article/Show', [
            'article' => $articleTransformer($article)
        ]);
    }
}
