<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   // GET /api/tasks
public function index()
{
    // $tasks = Task::all();
    $tasks = Task::all()->map(function ($task) {
        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'created_at' => $task->created_at,
            'updated_at' => $task->updated_at,
        ];
    });

    return response()->json([
        'success' => true,
        'message' => 'Task list fetched successfully',
        'tasks' => $tasks
    ], 200);
}


    // POST /api/tasks
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    // PUT or PATCH /api/tasks/{id}
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    // DELETE /api/tasks/{id}
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.']);
    }
}