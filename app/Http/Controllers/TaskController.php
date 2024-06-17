<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['creator', 'assignedUser', 'assignedBuilding'])->get();
        $users = User::all();

        return view('tasks.index', compact('tasks', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buildings = Building::all();
        $users = User::all();
        return view('tasks.create', compact('buildings', 'users'));
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
            'created_by' => 'required',
            'assigned_to_user' => 'required|exists:users,id',
            'assigned_to_building' => 'required|exists:buildings,id',
        ]);

        $validated['status'] = 'open';

        // Create the task
        Task::create($validated);

        // Redirect to the task list with success message
        return redirect()->route('buildings.index')->with('success', 'Task created successfully.');
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

    public function update(Request $request, $id)
    {
        // Validação dos dados (opcional, dependendo do seu caso)
        $request->validate([
            'status' => 'required|in:open,in_progress,completed,rejected',
        ]);

        // Busca a task pelo ID
        $task = Task::findOrFail($id);

        // Atualiza o status da task
        $task->status = $request->status;
        $task->save();

        // Redireciona de volta para a página de edição da task ou para onde for adequado
        return redirect()->route('tasks.edit', $id)->with('success', 'Status updated successfully.');
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
