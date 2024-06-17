<!DOCTYPE html>
<html>
<head>
    <title>Buildings</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #ECF0F1;
            color: #34495E;
        }

        .building-container {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
            background-color: #FFFFFF;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .building-container:hover {
            background-color: #BDC3C7;
        }

        .building-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .building-details h2 {
            margin: 0;
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

        .btn-danger {
            background-color: #E74C3C;
            color: #fff;
            border-color: #E74C3C;
        }

        .btn-danger:hover {
            background-color: #C0392B;
            border-color: #C0392B;
        }

        .tasks-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tasks-table th,
        .tasks-table td {
            border: 1px solid #BDC3C7;
            padding: 10px;
            text-align: left;
        }

        .tasks-table th {
            background-color: #2C3E50;
            color: #FFFFFF;
        }

        .tasks-table td {
            background-color: #FFFFFF;
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
