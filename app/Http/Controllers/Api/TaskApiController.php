<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->orderBy('due_date', 'desc')->get();
        return response()->json($tasks, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task = auth()->user()->tasks()->create($request->all());

        return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($task, 200);
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

        if ($task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->update($request->all());

        return response()->json(['message' => 'Task updated successfully', 'task' => $task], 200);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
