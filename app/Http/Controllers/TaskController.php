<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['creator', 'assignedUser', 'assignedBuilding'])->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'comment' => 'nullable|string',
            'created_by' => 'required|integer',
            'assigned_to_user' => 'required|integer',
            'assigned_to_building' => 'required|integer',
            'status' => 'required|string|max:50',
        ]);

        // Create the task
        Task::create($validated);

        // Redirect to the task list with success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::with(['assignedUser', 'creator', 'assignedBuilding'])->findOrFail($id);
        $comments = Comment::where('task_id', '=', $id)->with(['user'])->get();

        return view('tasks.edit', compact('task', 'comments'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Delete the task
        $task->delete();

        // Redirect to the task list with success message
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
