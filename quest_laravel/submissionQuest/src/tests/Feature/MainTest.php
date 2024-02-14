<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MainTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // テスト用データベースに seed を実行する
        Artisan::call('migrate:fresh --seed');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ユーザーを新規登録してDBに保存ができるか()
    {
        $data = [
            'name'                  => 'tsutsuhiko2',
            'email'                 => 'tsutsuhiko2@email.com',
            'password'              => 'test12345',
            'password_confirmation' => 'test12345',
        ];

        $response = $this->postJson(route('register'), $data);

        $response->assertStatus(302)
            ->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name'    => 'tsutsuhiko2',
            'email'   => 'tsutsuhiko2@email.com',
        ]);
    }
}
