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
    <title>Stock Report</title>
</head>
<body>
<div class="page-break">
    <div class="report-head">
        <h1>{{ __( session('title') ) }} - Stock Report</h1>
        <strong>{{ old('start_date', $start_date) }} TILL DATE {{ old('end_date', $end_date) }} </strong>
    </div>
    <table>
        <thead>
        <tr>
            <th style="width: 10%;text-align: center;">Date</th>
            <th style="width: 20%;text-align: left;padding-left: 4px;">Division Name</th>
            <th style="width: 30%;text-align: left;padding-left: 4px;">Product Title</th>
            <th style="width: 10%;text-align: right;padding-right: 4px;">Price (Rs)</th>
            <th style="width: 10%;text-align: right;padding-right: 4px;">Total Qty</th>
            <th style="width: 10%;text-align: right;padding-right: 4px;">Total (Rs)</th>
        </tr>
        </thead>
        <tbody>
        @php
        $totalSum = 0;
        @endphp
        @if(isset($stocks))
        @foreach($stocks as $stock)
        <tr>
            <td style="text-align: center; padding: 0;">{{$stock->date}}</td>
            <td style="text-align: left; padding: 0;padding-left: 4px;">{{$stock->division->division_name}}</td>
            <td style="text-align: left; padding: 0;padding-left: 4px;">{{$stock->product->name}}</td>
            <td style="text-align: right; padding: 0;padding-right: 4px;">{{number_format($stock->price,2)}}</td>
            <td style="text-align: right; padding: 0;padding-right: 4px;">{{$stock->qty}}</td>
            <td style="text-align: right; padding: 0;padding-right: 4px;">{{number_format($stock->total,2)}}</td>
        </tr>
        @php
        $totalSum += $stock->total;
        @endphp
        @endforeach
        @else
        <tr>
            <td colspan="6">
                <div class="alert alert-default text-center"><span
                        class="glyphicon glyphicon-warning-sign"></span> Not found data!
                </div>
            </td>
        </tr>
        @endif
        </tbody>
        <tfoot>
        <tr class="text-right">
            <td colspan="4"></td>
            <td colspan="1"><b>Grand Total</b></td>
            <td><b>Rs. {{number_format($totalSum,2)}}</b></td>
        </tr>
        </tfoot>
    </table>
</div>
</body>
</html>
