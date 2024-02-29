<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    public function create(Request $request)
    {
        // 認証済みユーザーを取得
        $user = Auth::user();

        // ユーザーが認証されているかチェック
        if ($user) {
            $article = new Article();
            $article->title = $request->input('title');
            $article->slug = Str::slug($request->title);;
            $article->description = $request->input('description');
            $article->body = $request->input('body');

            $article->save();

            return response()->json(['article' => [
                'title' => $article->title,
                'slug' => $article->slug,
                'description' => $article->description,
                'body' => $article->body,
                'createdAt' => $article->created_at,
                'updatedAt' => $article->updated_at,
            ]], 201);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function update(Request $request, Article $article)
    {
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            $article->title = $request->input('title');
            $article->description = $request->input('description');
            $article->body = $request->input('body');

            // 新しいslugを生成
            $newSlug = Str::slug($article->title);

            // 既存のslugと異なる場合のみ更新
            if ($article->slug !== $newSlug) {
                $article->slug = $newSlug;
            }

            $article->save();
            return response()->json(['article' => [
                'title' => $article->title,
                'slug' => $article->slug,
                'description' => $article->description,
                'body' => $article->body,
                'createdAt' => $article->created_at,
                'updatedAt' => $article->updated_at,
            ]], 201);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function get(Article $article) {
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            return response()->json(['article' => [
                'title' => $article->title,
                'slug' => $article->slug,
                'description' => $article->description,
                'body' => $article->body,
                'createdAt' => $article->created_at,
                'updatedAt' => $article->updated_at,
            ]], 201);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function delete(Article $article) {
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            $article->delete();
            return response()->json(['message' => 'Article deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

}
