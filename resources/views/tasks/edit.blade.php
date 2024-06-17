<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #ECF0F1;
            color: #34495E;
        }

        .task-info {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #BDC3C7;
            border-radius: 10px;
            background-color: #FFFFFF;
            margin-top: 20px;
            text-align: center;
        }

        .task-info h2 {
            margin-bottom: 10px;
        }

        .task-info .details {
            margin-bottom: 10px;
        }

        .comments-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #BDC3C7;
            border-radius: 10px;
            background-color: #FFFFFF;
        }

        .comment {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #E0E0E0;
            border-radius: 5px;
            background-color: #FFFFFF;
        }

        .comment .meta {
            font-size: 0.9rem;
            color: #666;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #BDC3C7;
            border-radius: 10px;
            background-color: #FFFFFF;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #2C3E50;
        }

        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #BDC3C7;
            border-radius: 4px;
            background-color: #ECF0F1;
            color: #34495E;
        }

        .form-group textarea {
            resize: vertical;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #3498DB;
            color: #FFFFFF;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980B9;
        }

        .btn-secondary {
            background-color: #18BC9C;
            color: #FFFFFF;
        }

        .btn-secondary:hover {
            background-color: #1ABC9C;
        }
    </style>
</head>
<body>
    <h1>Edit Task</h1>

    <div class="task-info">
        <h2>{{ $task->title }}</h2>
        <div class="details">
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Created By:</strong> {{ $task->creator->name }}</p>
            <p><strong>Assigned to Building:</strong> {{ $task->assignedBuilding->name }}</p>
            <p><strong>Assigned to User:</strong> {{ $task->assignedUser->name }}</p>
            <p><strong>Status:</strong>
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="status-select" onchange="this.form.submit()">
                        <option value="open" {{ $task->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="rejected" {{ $task->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>
            </p>
            <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y') }}</p>
            <p><strong>Updated At:</strong> {{ \Carbon\Carbon::parse($task->updated_at)->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="comments-container">
        <h2>Comments</h2>
        @foreach ($comments as $comment)
            <div class="comment">
                <p>{{ $comment->content }}</p>
                <div class="meta">
                    <p>Created By: {{ $comment->user->name }}</p>
                    <p>Created At: {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y') }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="form-container">
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
            <div class="form-group">
                <label for="comment">Add Comment:</label>
                <textarea id="comment" name="comment" required></textarea>
            </div>
            <button type="submit" class="btn">Add Comment</button>
        </form>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
        <a href="{{ route('buildings.index') }}" class="btn btn-secondary">Back to Buildings</a>
    </div>

</body>
</html>
