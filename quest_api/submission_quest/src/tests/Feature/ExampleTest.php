<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    /**
     * 記事を投稿してDBに保存されているのか確認するためのテスト
     *
     * @return void
     */
    public function test_to_see_if_articles_are_submitted_and_saved_in_DB()
    {
        // テストユーザーを作成
        $user = new User();
        $user->username = 'testuser';
        $user->email = 'test@example.com';
        $user->password = bcrypt('password');
        $user->save();

        // 認証トークンを取得
        $token = $user->createToken('TestToken')->plainTextToken;

        // テストデータ
        $data = [
            'title' => 'test title',
            'description' => 'test description',
            'body' => 'test body',
        ];

        // 認証トークンをリクエストヘッダーに含めてリクエストを送信
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson(route('create'), $data);

        // レスポンスのステータスコードを検証
        $response->assertStatus(201);

        // データベースに記事が保存されているか検証
        $this->assertDatabaseHas('articles', [
            "title" => "test title",
            "slug" => "test-title",
            "description" => "test description",
            "body" => "test body",
        ]);
    }
}
