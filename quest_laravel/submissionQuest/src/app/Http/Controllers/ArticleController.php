<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use App\Models\Comment;

class ArticleController extends Controller
{
    public function index()
    {
        // 記事の取得
        $articles = Article::orderBy('id', 'desc')->paginate(3);;

        // タグの登録数を集計し、上位10件を取得する
        $popularTags = Tag::withCount('articles')->orderByDesc('articles_count')->limit(10)->get();

        // ビューにデータを渡す
        return view('home', [
            "articles" => $articles,
            "popularTags" => $popularTags
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

        // タグの情報を取得し、コンマで分割して配列に格納
        $tags = explode(',', $request->tag_list);

        // タグを保存
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
            $article->tags()->attach($tag->id);
        }

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
        // $article = Article::find($id);
        // $comments = $article->comments;
        // return view('article', [
        //     "article" => $article,
        //     "comments" => $comments
        // ]);
        $article = Article::with('comments')->find($id);
        $comments = $article->comments; // コメントを取得
        return view('article', [
            "article" => $article,
            "comments" => $comments, // コメントをビューに渡す
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
