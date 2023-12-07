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
    <title>Product Wise Report</title>
</head>
<body>
<div class="page-break">
    <div class="report-head">
        <h1>{{ __( session('title') ) }} - Product Wise Report</h1>
    </div>

    <table style="margin-top: 20px">
        <thead>
        <tr>
            <th class="text-left" style="text-align: center">ID</th>
            <th class="text-left">Add Date</th>
            <th class="text-left">Product Name</th>
            <th class="text-left">Category Name</th>
            <th class="text-left">Division Name</th>
            <th class="text-left">In-stock</th>
            <th class="text-left">Buy Price (Rs)</th>
            <th class="text-left">Sell Price (Rs)</th>
            <th class="text-left">Manufacture Date</th>
            <th class="text-left">Expired Date</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($products))
            @foreach($products as $product)
            <tr>
                <td class="text-left" style="text-align: center">{{$product->id}}</td>
                <td class="text-left">{{$product->created_at}}</td>
                <td class="text-left">{{$product->name}}</td>
                <td class="text-left">{{$product->category->cate_name}}</td>
                <td class="text-left">{{$product->division->division_name}}</td>
                <td class="text-left">{{$product->qty}}</td>
                <td class="text-left">{{$product->buy_price}}</td>
                <td class="text-left">{{$product->sell_price}}</td>
                <td class="text-left">{{$product->manu_date}}</td>
                <td class="text-left">{{$product->exp_date}}</td>
            </tr>
            @endforeach
        @else
        <tr>
            <td colspan="10">
                <div class="alert alert-default text-center"><span class="glyphicon glyphicon-warning-sign"></span> Not found data!</div>
            </td>
        </tr>
        @endif
        </tbody>
    </table>
</div>
</body>
</html>
