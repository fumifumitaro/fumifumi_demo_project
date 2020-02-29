<?php


namespace App\Transformer;


use App\Models\Article;

class ArticleTransformer
{
    public function __invoke(Article $article)
    {
        $data = [
            'id' => $article->id,

            'username' => $article->user->name,
            'content' => $article->content,

            'date' => $article->created_at->format('Y.m.d h:i'),
        ];

        return $data;
    }
}