@extends('../layout.layout')

@section('title', 'Reports')

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-12 margin-top-20">
            <div class="d-inline-flex">
                <div class="p-2"><a href="/list-reports">Back</a></div>
                <div class="p-2"><h2>Low Stock Product Report</h2></div>
            </div>

            <hr>
            <form action="/filter-low-stock-product" method="POST" class="report px-20-30">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <label for="start_date">Low Quantity</label>
                        <input type="number" name="low_qty" class="form-control" value="{{ $low_qty }}" min="0">
                    </div>
                    <div class="col-md-5">
                        <label for="end_date">High Quantity</label>
                        <input type="number" name="high_qty" class="form-control" value="{{ $high_qty }}" min="0">
                    </div>
                    <div class="col-md-2">
                        <label name="button"> </label>
                        <button type="submit" class="btn btn-success btn-block" name="button"><i class="glyphicon glyphicon-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 margin-top-20">
            @if(isset($lowStocks))
            <form action="/download-low-stock-product-PDF" method="POST">
                @csrf
                <input type="hidden" name="low_qty" class="form-control" value="{{ $low_qty }}">
                <input type="hidden" name="high_qty" class="form-control" value="{{ $high_qty }}">
                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-download-alt"></i> Download Report</button>
            </form>
            @endif

            <hr>
            <div class="page-break report" id="report-summary">
                <div class="report-head">
                    <h1>{{ __( session('title') ) }} - Low Stock Product Report</h1>
                    @if(isset($lowStocks))
                    <h4 style="font-weight: bold" class="text-danger">Low Stock Product(s) - {{count($lowStocks)}}</h4>
                    @endif
                </div>
                <table class="table table-border report-table">
                    <thead>
                    <tr>
                        <th style="text-align: center">ID</th>
                        <th>Quantity </th>
                        <th>Product Name</th>
                        <th>Division Name</th>
                        <th style="text-align: right">Price (Rs)</th>
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
                                <td class="text-left">{{$lowStock->qty}}</td>
                                <td class="text-left">{{$lowStock->name}}</td>
                                <td class="text-left">{{$lowStock->division->division_name}}</td>
                                <td class="text-right" style="text-align: right">{{number_format($lowStock->sell_price,2)}}</td>
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
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

@endsection
