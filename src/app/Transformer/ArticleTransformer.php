<?php


namespace App\Transformer;


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
        ];

        return $data;
    }
}