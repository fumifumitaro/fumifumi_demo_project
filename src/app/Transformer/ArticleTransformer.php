<?php


namespace App\Transformer;

use App\Models\UserBookmark;
use App\Models\Article;
use Parsedown;

class ArticleTransformer
{
    public function __invoke(Article $article)
    {
        $parse = new Parsedown();

        $data = [
            'id' => $article->id,

            'username' => $article->user->name,

            'title' => $article->title,
            'content' => $parse->text($article->content),

            'date' => $article->created_at->format('Y/m/d h:i'),
            'bookmark' => $article->user_bookmarks ? $article->user_bookmarks->bookmark : 0,
        ];
        // logger($data);

        return $data;
    }
}