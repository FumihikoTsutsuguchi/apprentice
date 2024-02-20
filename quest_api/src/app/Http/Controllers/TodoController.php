<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function create(Request $request)
    {
        $todo = new Todo();
        $todo->title = $request->input('title');
        $todo->save();
        return response()->json(Todo::all());
    }

    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    public function update(Int $id, Request $request)
    {
        $todo = Todo::find($id);
        $todo->title = $request->input('title');
        $todo->save();
        return response()->json($todo);
    }

    public function delete(Int $id)
    {
        $todo = Todo::find($id)->delete();
        return response()->json(Todo::all());
    }

}
