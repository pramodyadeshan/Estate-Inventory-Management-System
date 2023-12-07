<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 11px;
        }

        .report-head {
            margin: 4px 0;
            text-align: center;
        }

        .report-head h1, .report-head strong {
            padding: 10px 20px;
            display: block;
        }

        .report-head h1 {
            margin: 0;
            border-bottom: 1px solid #212121;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        table th, table td {
            text-align: left;
            border: 1px solid #3f3f3f;
            padding: 4px 4px; /* Added to remove padding */
        }

        table th {
            background-color: #f8f8f8;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        tfoot {
            color: #000;
            text-transform: uppercase;
            font-weight: 500;
            border-top: 2px solid #212121;
        }

        tfoot td {
            background-color: #f8f8f8;
        }
    </style>
    <title>User Wise Report</title>
</head>
<body>
<div class="page-break">
    <div class="report-head">
        <h1>{{ __( session('title') ) }} - User Wise Report</h1>
    </div>

    <table style="margin-top: 20px">
        <thead>
        <tr>
            <th class="text-left" style="text-align: center">ID</th>
            <th class="text-left">Name</th>
            <th class="text-left">Estate Name</th>
            <th class="text-left">User Role</th>
            <th class="text-left">Status</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($users))
            @foreach($users as $user)
                @if($user->id !== 1)
                <tr>
                    <td class="text-center" style="text-align: center">{{$user->id}}</td>
                    <td class="text-left">{{$user->name}}</td>
                    <td class="text-left">
                        @php
                        $stateIds = json_decode($user->state_id, true);
                        @endphp

                        {{ implode(', ', $stateIds ? $states_data->whereIn('id', $stateIds)->pluck('state_name')->toArray() : []) }}

                    </td>
                    <td class="text-left">{{$user->role->role_name}}</td>
                    <td class="text-left">{{$user->status == 1 ? 'Active' : 'Deactive'}}</td>
                </tr>
                @endif
            @endforeach
        @else
        <tr>
            <td colspan="5">
                <div class="alert alert-default text-center"><span class="glyphicon glyphicon-warning-sign"></span> Not
                    found data!
                </div>
            </td>
        </tr>
        @endif
        </tbody>
    </table>
</div>
</body>
</html>
