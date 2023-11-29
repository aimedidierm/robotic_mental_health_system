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
        <h2 class="text-2xl font-semibold mb-4">List of all patients from {{$district}}</h2>

        <table style="width: 100%" class="w-full table-auto border border-collapse">
            <thead>
                <tr>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Name
                    </th>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Email
                    </th>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Phone
                    </th>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Sponsor
                    </th>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Date of birth
                    </th>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Status
                    </th>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        Address
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($patients->isEmpty())
                <tr style="padding: 8px; border: 1px solid #0c0c0c;">
                    <td class="px-4 py-2 border" colspan="6">No available data</td>
                </tr>
                @else
                @foreach ($patients as $patient)
                <tr>
                    <th style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$patient->name}}
                    </th>
                    <td style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$patient->email}}
                    </td>
                    <td style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$patient->phone}}
                    </td>
                    <td style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$patient->sponsor}}
                    </td>
                    <td style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$patient->age}}
                    </td>
                    <td style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$patient->m_status}}
                    </td>
                    <td style="padding: 8px; border: 1px solid #0c0c0c;">
                        {{$patient->province}}, {{$patient->district}}
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>