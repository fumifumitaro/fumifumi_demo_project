<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Transformer\ArticleTransformer;
use Dakatsuka\MonologFluentHandler\FluentHandler;
use Inertia\Inertia;
use Monolog\Handler\StreamHandler;

class HomeController extends Controller
{
    public function __invoke()
    {
        $logger = new \Monolog\Logger('local');
        $logger->setHandlers([
            new StreamHandler(__DIR__ . '/aiueo', 100),
            new FluentHandler(null, 'fluentd', '24224')
        ]);
        $logger->error("debug.test", ["hello"=>"world"]);

        $fluent = new FluentHandler();

        $fluent->write([
            'channel' => 'local',
            'message' => 'whoops!!!',
            'context' => [
               'time' => time()
            ],
            'level' => '500'
        ]);

        return Inertia::render('Home/Index', [
            'articles' => $this->fetchArticles(),
        ]);
    }

    private function fetchArticles()
    {
        return Article::with('user')
            ->orderBy('created_at')
            ->get()
            ->transform(new ArticleTransformer)
            ->all();
    }
}
