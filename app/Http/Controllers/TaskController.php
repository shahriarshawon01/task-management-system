<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        $tasks = auth()->user()->tasks()->get();
        return view('admin.taskManagement.index', compact('tasks', 'users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        auth()->user()->tasks()->create($request->all());
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        $task = Task::find($request->task_id);
        dd($task);
        if ($task) {
            $task->status = $request->status;
            $task->save();
        }

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }
}
