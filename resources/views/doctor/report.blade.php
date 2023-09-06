<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>item list report</title>
    <style>
        .container {
            margin-left: auto;
            margin-right: auto;
            padding: 16px;
        }

        .text-2xl {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e2e8f0;
        }

        .table th,
        .table td {
            padding: 8px;
            border: 1px solid #e2e8f0;
        }
    </style>
</head>

<body class="bg-opacity-50">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">List of all schedules</h2>

        <table class="w-full table-auto border border-collapse">
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Patient
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($data->isEmpty())
                <tr>
                    <td class="px-4 py-2 border" colspan="5">No available data</td>
                </tr>
                @else
                @foreach ($data as $schedule)
                <tr>
                    <th>
                        {{$schedule->date}}
                    </th>
                    <td>
                        {{$schedule->title}}
                    </td>
                    <td>
                        {{$schedule->patient->name}}
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>