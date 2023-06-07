<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\UserBookmark;
use App\Models\UserLike;
use App\Transformer\ArticleTransformer;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Home/Index', [
            'articles' => $this->fetchArticles(),
        ]);
    }

    private function fetchArticles()
    {
        return Article::with('user', 'user_bookmarks', 'user_like')
            ->orderBy('created_at')
            ->get()
            ->transform(new ArticleTransformer)
            ->all();
    }
}
