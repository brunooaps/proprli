<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #ECF0F1;
            color: #34495E;
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

        .form-group input,
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
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980B9;
        }

        .btn-secondary {
            background-color: #18BC9C;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #1ABC9C;
        }
    </style>
</head>
<body>
    <h1>Create New Task</h1>

    <div class="form-container">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="assigned_to_building">Assign to Building:</label>
                <select id="assigned_to_building" name="assigned_to_building" required>
                    <option value="">Select Building</option>
                    @foreach($buildings as $building)
                        <option value="{{ $building->id }}">{{ $building->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="assigned_to_user">Assign to User:</label>
                <select id="assigned_to_user" name="assigned_to_user" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
            <button type="submit" class="btn">Create Task</button>
        </form>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
        <a href="{{ route('buildings.index') }}" class="btn btn-secondary">Back to Buildings</a>
    </div>

</body>
</html>
