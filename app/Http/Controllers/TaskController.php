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

    public function index(Request $request)
    {
        $status = $request->input('status');
        $users = User::all();
        $tasks = auth()->user()->tasks()->orderBy('due_date', 'desc')->get();

        if ($status) {
            $tasks = $tasks->where('status', $status);
        }

        return view('admin.taskManagement.index', compact('tasks', 'users'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.taskManagement.create', compact('users'));
    }

    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        auth()->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $task = Task::find($id);
        return view('admin.taskManagement.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::all();
        return view('admin.taskManagement.edit', compact('task', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function updateStatus(Request $request)
    {
        dd($request);
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'status' => 'required|in:Pending,In Progress,Completed',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);


        $task = Task::findOrFail($request->task_id);

        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
