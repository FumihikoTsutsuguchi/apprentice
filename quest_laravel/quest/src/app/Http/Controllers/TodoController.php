<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;

class TodoController extends Controller
{
    public function index() {
        $todos = Todo::orderBy('id', 'asc')->get();
        return view('todosList', [
            "todos" => $todos
        ]);
    }

    public function createPage() {
        return view('todosCreate');
    }

    public function create(Request $request) {
        $validator = $request->validate([
            'title' => 'required',
        ]);

        $todo = new Todo();
        $todo->title = $request->title;

        $todo->save();
        return redirect('/todos');
    }

    public function editPage($id) {
        $todo = Todo::find($id);
        return view('todosEdit', [
            "todo" => $todo
        ]);
    }

    public function edit(Request $request)
    {
        Todo::find($request->id)->update([
            'title' => $request->title,
        ]);
        return redirect('/todos');
    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->delete();
        }
        return redirect('/todos');
    }

}
