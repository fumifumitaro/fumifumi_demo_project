<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserBookmark;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookmarkController extends Controller
{

    public function updateOrCreate(Request $request)
    {
        $article_id = $request->input('article');
        $bookamrk = $request->input('bookmark');
        logger('postブックマークAPIが動作しています');
        logger($request->all());
        UserBookmark::updateOrCreate(['user_id' => Auth::id(), 'article_id' => $article_id, 'bookmark' => $bookamrk ]);

        return response()->json(['message' => 'success']);
    }
}
