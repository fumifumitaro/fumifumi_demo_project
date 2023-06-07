<?php


namespace App\Transformer;

use App\Models\User;
use App\Models\UserBookmark;
use App\Models\UserLike;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Parsedown;

class ArticleTransformer
{
    public function __invoke(Article $article)
    {
        $parse = new Parsedown();

        $data = [
            'user_id' => Auth::id(),
            'id' => $article->id,

            'username' => $article->user->name,

            'title' => $article->title,
            'content' => $parse->text($article->content),

            'date' => $article->created_at->format('Y/m/d h:i'),
            'bookmark' => $article->user_bookmarks->where('user_id', Auth::id())->first(),
            'like' => $article->user_like ? $article->user_like->like : 0,
        ];
        logger($data);

        return $data;
    }
}