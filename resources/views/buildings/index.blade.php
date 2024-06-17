<!DOCTYPE html>
<html>
<head>
    <title>Buildings</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .building-container {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .building-container:hover {
            background-color: #f0f0f0;
        }

        .building-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border-color: #dc3545;
        }

        .tasks-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .tasks-table th,
        .tasks-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Buildings</h1>

    <div class="building-list">
        @foreach ($buildings as $building)
            <div class="building-container" onclick="window.location='{{ route('tasks.index', ['building_id' => $building->id]) }}'">
                <div class="building-details">
                    <h2>{{ $building->name }}</h2>
                    <span>Number of Tasks: {{ $building->tasks->count() }}</span>
                </div>
                <p>{{ $building->description }}</p>
            </div>
        @endforeach
    </div>

</body>
</html>
