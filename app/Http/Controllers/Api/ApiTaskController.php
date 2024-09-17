<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskApiResourceCollection;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->has('priority') && !is_null($request->priority)) {
            $query->where('priority', $request->priority);
        }

        if ($request->has('due_date') && !is_null($request->due_date)) {
            $query->whereDate('due_date', $request->due_date);
        }

        $tasks = $query->get();

        return response()->json([
            'status' => true,
            'message' => 'Task retrieved successfully',
            'data' => TaskApiResourceCollection::collection($tasks),
        ], 201);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date|after_or_equal:today',
            'priority' => 'required|in:1,2,3',
        ], [
            'priority.required' => 'Please select a priority level.',
        ]);

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Task created successfully',
            'task' => $task,
            'redirect_url' => route('taskList'),
        ], 201);
    }

    public function show($id)
    {
        $task = Task::find($id);
        if ($task->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Task retrieved successfully',
            'task' => $task,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if ($task->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date|after_or_equal:today',
            'priority' => 'required|in:1,2,3',
        ], [
            'priority.required' => 'Please select a priority level.',
        ]);

        $task->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Task updated successfully',
            'task' => $task,
            'redirect_url' => route('taskList'),
        ], 201);
    }

    public function destroy(Request $request)
    {
        $task = Task::find($request->id);

        if ($task->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json([
            'status' => true,
            'message' => 'Task deleted successfully',
            'redirect_url' => route('taskList'),
        ], 201);
    }
}
