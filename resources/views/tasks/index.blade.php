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

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
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

        .filter-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-form input,
        .filter-form select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .filter-form button {
            padding: 8px 12px;
            border: 1px solid #007bff;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Tasks</h1>

    <!-- Botão para página de criação -->
    <div class="form-container">
        @if(Auth::user()->isOwner())
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
        @endif
        <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Formulário de Filtro -->
    <form action="{{ route('tasks.index') }}" method="GET" class="filter-form">
        <!-- Filtro por building (oculto) -->
        <input type="hidden" name="building_id" value="{{ request('building_id') }}">

        <!-- Filtro por data -->
        <input type="date" name="date" value="{{ request('date') }}">
        
        <!-- Filtro por usuário -->
        <select name="assigned_user">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('assigned_user') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        
        <!-- Filtro por status -->
        <select name="status">
            <option value="">Select Status</option>
            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
        
        <!-- Botão de filtro -->
        <button type="submit" class="btn">Filter</button>
    </form>

    <!-- Tabela de Tasks -->
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
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                @php
                    $assignedUserId = $task->assignedUser ? $task->assignedUser->id : null;
                @endphp
                @if ((!request('assigned_user') || $assignedUserId == request('assigned_user')) &&
                     (!request('status') || $task->status == request('status')) &&
                     (!request('date') || $task->created_at->format('Y-m-d') == request('date')) &&
                     (!request('building_id') || $task->assigned_to_building == request('building_id')))
                    <tr class="task-row" data-url="{{ route('tasks.edit', $task->id) }}">
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->creator->name }}</td>
                        <td>{{ $task->assignedBuilding->name }}</td>
                        <td>{{ $task->assignedUser ? $task->assignedUser->name : '-' }}</td>
                        <td>{{ $task->status }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @endif
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
