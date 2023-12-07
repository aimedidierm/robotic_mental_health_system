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
        <img src="{{'rbc.png'}}" alt="" width="400" height="200">
        <center>
            <h2 class="text-2xl font-semibold mb-4">List of all schedules</h2>
        </center>

        <table style="width: 100%" class="w-full table-auto border border-collapse">
            <thead>
                <tr>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Doctor
                    </th>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Patient
                    </th>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Mentor Issue
                    </th>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Date
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($data->isEmpty())
                <tr style="padding: 8px; border: 1px solid #0c0c0c;">
                    <td class="px-4 py-2 border" colspan="5">No available data</td>
                </tr>
                @else
                @foreach ($data as $schedule)
                <tr>
                    <td style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$schedule->doctor->name}}
                    </td>
                    <td style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$schedule->patient->name}}
                    </td>
                    <td style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$schedule->title}}
                    </td>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$schedule->date}}
                    </th>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <h6 class="text-2xl font-semibold mb-4">Printed on: {{now()}}</h6>
    <h6 class="text-2xl font-semibold mb-4">Printed by {{Auth::user()->name}}</h6>
</body>

</html>