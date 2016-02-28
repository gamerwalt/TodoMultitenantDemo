<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use TodoApp\Models\Todo;

class TodosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('authTenant');
    }

    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        return view('tenant.todos.create');
    }

    public function postCreate(CreateTodoRequest $request)
    {
        $todoInput = $request->input('todo');

        $todo = new Todo();
        $todo->body = $todoInput;
        $todo->created_by = Auth::user()->name;
        $todo->save();

        return redirect()->route('todos');
    }

    public function toggle($body)
    {
        $todo = Todo::whereBody($body)->firstOrFail();
        $todo->completed = !$todo->completed;
        $todo->updated_by = Auth::user()->name;
        $todo->update();

        return redirect()->route('todos');
    }
}
