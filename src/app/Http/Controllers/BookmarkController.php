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
        $user = Auth::id();
        $articleId = $request->input('article');
        $bookmarkId = $request->input('bookmark');

        $userBookmark = UserBookmark::where('user_id', $user)
                        ->where('article_id', $articleId)
                        ->first();

        logger($request); 

        if ($userBookmark) {
            $userBookmark->update(['bookmark' => $bookmarkId]);
        } else {
            UserBookmark::create(['user_id' => $user, 'article_id' => $articleId, 'bookmark' => $bookmarkId]);
        }
        
        return response()->json(['message' => 'success']);
    }

}
