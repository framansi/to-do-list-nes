<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        Task::create($request->validate(
            [
                'description' => ['required', 'string', 'max:255']
            ]
        ));
        return to_route('tasks.index');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return to_route('tasks.index');
    }
}
