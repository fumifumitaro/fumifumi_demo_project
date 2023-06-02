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
        $user_id = Auth::id();
        $article_id = $request->input('article');
        $bookmark = $request->input('bookmark');

        $bookmarkModel = UserBookmark::where('user_id', $user_id)
                        ->where('article_id', $article_id)
                        ->first();

        if ($bookmarkModel) {
            $bookmarkModel->update(['bookmark' => $bookmark]);
        } else {
            UserBookmark::create(['user_id' => $user_id, 'article_id' => $article_id, 'bookmark' => $bookmark]);
        }
        
        return response()->json(['message' => 'success']);
    }

}
