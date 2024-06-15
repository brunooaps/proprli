<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .form-container {
            margin-bottom: 20px;
        }
        .btn {
            padding: 8px 12px;
            margin-right: 5px;
            text-decoration: none;
            border: 1px solid #000;
            border-radius: 4px;
            background-color: #f0f0f0;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .btn-warning {
            background-color: #ffc107;
            color: #fff;
            border-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <h1>Tasks</h1>

    <!-- Botão para página de criação -->
    <div class="form-container">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Created By</th>
                <th>Assigned To Building</th>
                <th>Assigned To User</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="task-row" data-url="{{ route('tasks.edit',$task->id) }}">
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->creator->name }}</td>
                    <td>{{ $task->assignedBuilding->name }}</td>
                    <td>{{ $task->assignedUser->name }}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->created_at }}</td>
                    <td>{{ $task->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        // Adiciona evento de clique para redirecionar ao clicar na linha da tabela
        document.querySelectorAll('.task-row').forEach(row => {
            row.addEventListener('click', () => {
                const url = row.dataset.url;
                if (url) {
                    window.location.href = url;
                }
            });
        });
    </script>
</body>
</html>
