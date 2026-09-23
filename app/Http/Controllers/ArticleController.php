<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::current();
        $articles = Article::published()->orderByDesc('published_at')->paginate(9);

        return view('articles.index', compact('settings', 'articles'));
    }

    public function show(Request $request, Article $article)
    {
        abort_unless($article->is_published, 404);

        $sessionKey = 'viewed_article_'.$article->id;
        if (! $request->session()->has($sessionKey)) {
            $article->increment('views_count');
            $request->session()->put($sessionKey, true);
        }

        $settings = SiteSetting::current();
        $related = Article::published()->where('id', '!=', $article->id)->take(3)->get();

        return view('articles.show', compact('settings', 'article', 'related'));
    }
}
