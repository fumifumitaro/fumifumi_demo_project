<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Transformer\ArticleTransformer;
use Illuminate\Http\Request;
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
    {   dd(User);
        return Article::with('user')
            ->orderBy('created_at')
            ->get()
            ->transform(new ArticleTransformer)
            ->all();
    }       
    
}
/*dd(User::all())を追加しますuserに */