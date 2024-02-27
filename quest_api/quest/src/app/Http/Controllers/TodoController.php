<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function home()
    {
        return view('index');
    }

    public function create(Request $request)
    {
        // 認証済みユーザーを取得
        $user = Auth::user();

        // ユーザーが認証されているかチェック
        if ($user) {
            $todo = new Todo();
            $todo->title = $request->input('title');
            $todo->save();
            return response()->json(Todo::all());
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function index()
    {
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            $todos = Todo::all();
            return response()->json($todos);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

    public function update(Int $id, Request $request)
    {
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            $todo = Todo::find($id);
            $todo->title = $request->input('title');
            $todo->save();
            return response()->json($todo);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

    public function delete(Int $id)
    {
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            $todo = Todo::find($id)->delete();
            return response()->json(Todo::all());
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }

}
