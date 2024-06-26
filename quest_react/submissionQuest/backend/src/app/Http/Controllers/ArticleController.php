<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function articles(Request $request)
    {
        // 記事を取得
        $articles = Article::with('tags') // タグ情報も同時に取得
                    ->get()
                    ->map(function ($article) {
                        // タグ名の配列を作成
                        $tagNames = $article->tags->map(function ($tag) {
                            return $tag->name;
                        })->toArray();

                        // 必要な情報のみを含む新しい配列を返す
                        return [
                            'slug' => $article->slug,
                            'title' => $article->title,
                            'description' => $article->description,
                            'body' => $article->body,
                            'tagList' => $tagNames,
                            'createdAt' => $article->created_at->toIso8601String(),
                            'updatedAt' => $article->updated_at->toIso8601String(),
                            'favorited' => false, // 実際のアプリケーションでは、お気に入り状態を適切に設定
                            'favoritesCount' => 0, // 実際のアプリケーションでは、お気に入りの数を計算
                        ];
                    });

        // 応答用のデータを作成
        $response = [
            'articles' => $articles,
            'articlesCount' => $articles->count(),
        ];

        return response()->json($response);
    }

    public function create(Request $request)
    {
        /**
         * if elseはなるべく使わないようにする（おそらく認証専用のクラスがある？？）
         * サービスクラスに集約するのがおすすめ
         */

            $article = new Article();
            $article->title = $request->input('title');
            $article->slug = Str::slug($request->title);
            $article->description = $request->input('description');
            $article->body = $request->input('body');
            $article->save();

            // タグの情報を取得し、コンマで分割して配列に格納
            $tags = explode(',', $request->input('tags'));

            // タグを保存
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $article->tags()->attach($tag->id);
            }


            return response()->json(['article' => [
                'title' => $article->title,
                'slug' => $article->slug,
                'description' => $article->description,
                'body' => $article->body,
                'tagList' => $tags,
                'createdAt' => $article->created_at,
                'updatedAt' => $article->updated_at,
            ]], 201);

    }

    public function update(Request $request, Article $article)
    {
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            $article->title = $request->input('title');
            $article->description = $request->input('description');
            $article->body = $request->input('body');
            $article->save();

            // タグの情報を取得し、コンマで分割して配列に格納
            $tags = explode(',', $request->input('tags'));

            // タグを保存
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $article->tags()->attach($tag->id);
            }

            // 新しいslugを生成
            $newSlug = Str::slug($article->title);

            // 既存のslugと異なる場合のみ更新
            if ($article->slug !== $newSlug) {
                $article->slug = $newSlug;
            }

            return response()->json(['article' => [
                'title' => $article->title,
                'slug' => $article->slug,
                'description' => $article->description,
                'body' => $article->body,
                'tagList' => $tags,
                'createdAt' => $article->created_at,
                'updatedAt' => $article->updated_at,
            ]], 201);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function get(Article $article) {
        // タグリストを初期化
        $tags = [];
        // 記事に関連付けられたタグを取得
        foreach ($article->tags as $tag) {
            $tags[] = $tag->name;
        }

        return response()->json(['article' => [
            'title' => $article->title,
            'slug' => $article->slug,
            'description' => $article->description,
            'body' => $article->body,
            'tagList' => $tags,
            'createdAt' => $article->created_at,
            'updatedAt' => $article->updated_at,
        ]], 201);
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

    public function favorite(Request $request, Article $article){
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            $user_id = Auth::id();

            // 既にいいねしているかチェック
            $existingFavorite = Favorite::where('article_id', $article->id)
                ->where('user_id', $user_id)
                ->first();

            // 既にいいねしている場合は何もせず、そうでない場合は新しいいいねを作成する
            if (!$existingFavorite) {
                $favorite = new Favorite();
                $favorite->article_id = $article->id;
                $favorite->user_id = $user_id;
                $favorite->save();
            }

            // 記事のいいね状態を返す
            return response()->json([
                'article' => [
                    'slug' => $article->slug,
                    'title' => $article->title,
                    'description' => $article->description,
                    'body' => $article->body,
                    'tagList' => $article->tags->pluck('name'),
                    'createdAt' => $article->created_at,
                    'updatedAt' => $article->updated_at,
                    'favorited' => true, // いいねされた状態を示す
                    'favoritesCount' => $article->favorites()->count(), // いいねの合計数を取得
                ]
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

    public function unfavorite(Request $request, Article $article){
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            $user_id = Auth::id();

            // いいねを削除する
            Favorite::where('article_id', $article->id)
                ->where('user_id', $user_id)
                ->delete();

            // 記事のいいね状態を返す
            return response()->json([
                'article' => [
                    'slug' => $article->slug,
                    'title' => $article->title,
                    'description' => $article->description,
                    'body' => $article->body,
                    'tagList' => $article->tags->pluck('name'),
                    'createdAt' => $article->created_at,
                    'updatedAt' => $article->updated_at,
                    'favorited' => false, // いいねが取り消された状態を示す
                    'favoritesCount' => $article->favorites()->count(), // いいねの合計数を取得
                ]
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

}
