@extends('../layout.layout')

@section('title', 'Reports')

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-12 margin-top-20">
            <div class="d-inline-flex">
                <div class="p-2"><a href="/list-reports">Back</a></div>
                <div class="p-2"><h2>Daily Stock Report</h2></div>
            </div>
        </div>
        <div class="col-md-12 margin-top-20">
            @if(isset($stocks))
                <a href="/download-daily-stock-PDF" class="btn btn-primary"><i class="glyphicon glyphicon-download-alt"></i> Download Report</a>
            @endif

            <hr>
            <div class="page-break report" id="report-summary">
                <div class="report-head">
                    <h1>{{ __( session('title') ) }} - Daily Stock Report</h1>
                    <h3>Today - {{ date('Y-m-d') }} </h3>
                </div>
                <table class="table table-border report-table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Division Name</th>
                        <th>Product Title</th>
                        <th style="text-align: right;">Price (Rs)</th>
                        <th style="text-align: right;">Total Qty</th>
                        <th style="text-align: right;">Total (Rs)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalSum = 0;
                    @endphp
                    @if(isset($stocks))
                        @foreach($stocks as $stock)
                            <tr>
                                <td class="text-left">{{$stock->date}}</td>
                                <td class="text-left">{{$stock->division->division_name}}</td>
                                <td class="text-left">{{$stock->product->name}}</td>
                                <td class="text-right">{{number_format($stock->price,2)}}</td>
                                <td class="text-right">{{$stock->qty}}</td>
                                <td class="text-right">{{number_format($stock->total,2)}}</td>
                            </tr>
                            @php
                                $totalSum += $stock->total;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-default text-center"><span class="glyphicon glyphicon-warning-sign"></span> Not found data!</div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                    <tfoot>
                    <tr class="text-right">
                        <td colspan="4"></td>
                        <td colspan="1"><b>Grand Total</b></td>
                        <td> <b>Rs. {{number_format($totalSum,2)}}</b> </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
@endsection
