<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #ECF0F1;
            color: #34495E;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #BDC3C7;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #2C3E50;
            color: #FFFFFF;
        }

        td {
            background-color: #FFFFFF;
        }

        .btn {
            padding: 8px 12px;
            margin-right: 5px;
            text-decoration: none;
            border: 1px solid transparent;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-primary {
            background-color: #3498DB;
            color: #fff;
            border-color: #3498DB;
        }

        .btn-primary:hover {
            background-color: #2980B9;
            border-color: #2980B9;
        }

        .btn-secondary {
            background-color: #18BC9C;
            color: #fff;
            border-color: #18BC9C;
        }

        .btn-secondary:hover {
            background-color: #1ABC9C;
            border-color: #1ABC9C;
        }

        .btn-warning {
            background-color: #F39C12;
            color: #fff;
            border-color: #F39C12;
        }

        .btn-warning:hover {
            background-color: #E67E22;
            border-color: #E67E22;
        }

        .btn-danger {
            background-color: #E74C3C;
            color: #fff;
            border-color: #E74C3C;
        }

        .btn-danger:hover {
            background-color: #C0392B;
            border-color: #C0392B;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-form input,
        .filter-form select {
            padding: 8px;
            border: 1px solid #BDC3C7;
            border-radius: 4px;
        }

        .filter-form button {
            padding: 8px 12px;
            border: 1px solid #3498DB;
            border-radius: 4px;
            background-color: #3498DB;
            color: #fff;
        }

        .filter-form button:hover {
            background-color: #2980B9;
            border-color: #2980B9;
        }

        .task-row {
            cursor: pointer;
        }

        .task-row:hover {
            background-color: #BDC3C7;
        }
    </style>
</head>

<body>
    <h1>Tasks</h1>

    <div class="form-container">
        @if(Auth::user()->isOwner())
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
        @endif
        <a href="{{ route('buildings.index') }}" class="btn btn-secondary">Back to Buildings</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <form action="{{ route('tasks.index') }}" method="GET" class="filter-form">
        <input type="hidden" name="building_id" value="{{ request('building_id') }}">

        <input type="date" name="date" value="{{ request('date') }}">
        
        <select name="assigned_user">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('assigned_user') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        
        <select name="status">
            <option value="">Select Status</option>
            <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
        
        <button type="submit" class="btn">Filter</button>
    </form>

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
