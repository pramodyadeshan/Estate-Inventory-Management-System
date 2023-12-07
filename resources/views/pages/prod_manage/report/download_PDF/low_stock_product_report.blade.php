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
            text-align: center;
            border: 1px solid #3f3f3f;
            padding: 0; /* Added to remove padding */
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
    <title>Low Stock Product Report</title>
</head>
<body>
<div class="page-break">
    <div class="report-head">
        <h1>{{ __( session('title') ) }} - Low Stock Product Report</h1>
    </div>
    <h4 style="font-weight: bold" class="text-danger text-left">Low Stock Product(s) - {{count($lowStocks)}}</h4>
    <table>
        <thead>
        <tr>
            <th style="width: 4%;text-align: center;">ID</th>
            <th style="width: 10%;text-align: left;padding-left: 4px;">Quantity</th>
            <th style="width: 10%;text-align: left;padding-left: 4px;">Product Name</th>
            <th style="width: 20%;text-align: left;padding-left: 4px;">Division Name</th>
            <th style="width: 10%;text-align: right;padding-right: 4px;">Price (Rs)</th>
        </tr>
        </thead>
        <tbody>
        @php
            $totalSum = 0;
        @endphp
        @if(isset($lowStocks))
            @foreach($lowStocks as $lowStock)
            <tr>
                <td style="text-align: center">{{$lowStock->id}}</td>
                <td class="text-left" style="text-align: left;padding-left: 4px;"><b>{{$lowStock->qty}}</b></td>
                <td class="text-left" style="text-align: left;padding-left: 4px;">{{$lowStock->name}}</td>
                <td class="text-left" style="text-align: left;padding-left: 4px;">{{$lowStock->division->division_name}}</td>
                <td class="text-right" style="text-align: right;padding-right: 4px;">{{number_format($lowStock->sell_price,2)}}</td>
            </tr>
            @endforeach
        @else
        <tr>
            <td colspan="5">
                <div class="alert alert-default text-center"><span class="glyphicon glyphicon-warning-sign"></span> Not found data!</div>
            </td>
        </tr>
        @endif
        </tbody>
    </table>
</div>
</body>
</html>
