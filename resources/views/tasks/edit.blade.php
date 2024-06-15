<!DOCTYPE html>
<html>

<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .task-info {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            text-align: center;
            /* Centraliza o conteúdo */
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
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .comment {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #fff;
        }

        .comment .meta {
            font-size: 0.9rem;
            color: #666;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            /* Centraliza horizontalmente */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin-top: 20px;
            /* Espaçamento do topo */
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            resize: vertical;
            /* Permite redimensionamento vertical */
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
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
            <p><strong>Status:</strong> {{ $task->status }}</p>
            <p><strong>Created At:</strong> {{ $task->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $task->updated_at }}</p>
        </div>
    </div>

    <div class="comments-container">
        <h2>Comments</h2>
        @foreach ($comments as $comment)
            <div class="comment">
                <p>{{ $comment->content }}</p>
                <div class="meta">
                    <p>Created By: {{ $comment->user->name }}</p>
                    <p>Created At: {{ $comment->created_at }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="form-container">
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="task_id" value="{{ $task->id }}">
            Adicionar mais tarde, pois ainda não foi criado a lógica de login
            {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
            <div class="form-group">
                <label for="comment">Add Comment:</label>
                <textarea id="comment" name="comment" required></textarea>
            </div>
            <button type="submit" class="btn">Add Comment</button>
        </form>

    </div>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
</body>

</html>
