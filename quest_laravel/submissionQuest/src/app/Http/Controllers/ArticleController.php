<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('id', 'asc')->get();
        return view('home', [
        "articles" => $articles
        ]);
    }

    public function createEditArticle()
    {
        return view('createEditArticle');
    }

    public function createArticle(Request $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->body = $request->body;
        $article->save();

        return redirect('/');
    }

    public function editArticle($id)
    {
        $article = Article::find($id);
        return view('editArticle', [
            "article" => $article
        ]);
    }

    public function edit(Request $request)
    {
        Article::find($request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
        ]);

        return redirect('/');
    }


    public function article($id)
    {
        $article = Article::find($id);
        return view('article', [
            "article" => $article
        ]);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
        }
        return redirect('/');
    }

}
