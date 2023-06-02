<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserLike;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LikeController extends Controller
{

    public function updateOrCreate(Request $request)
    {
        logger($request);
        $user = Auth::id();
        $articleId = $request->input('article');
        $likeId = $request->input('like');

        $userLike = UserLike::where('user_id', $user)
                        ->where('article_id', $articleId)
                        ->first();

        if ($userLike) {
            $userLike->update(['like' => $likeId]);
        } else {
            UserLike::create(['user_id' => $user, 'article_id' => $articleId, 'like' => $likeId]);
        }
        
        return response()->json(['message' => 'success']);
    }

}
