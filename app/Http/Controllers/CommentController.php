<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'created_by' => 'required|exists:users,id',
            'comment' => 'required|string',
        ]);

        Comment::create([
            'task_id' => $request->task_id,
            'created_by' => $request->created_by,
            'content' => $request->comment,
        ]);

        return redirect()->route('tasks.edit', $request->task_id)->with('success', 'Comment added successfully.');
    }
}
