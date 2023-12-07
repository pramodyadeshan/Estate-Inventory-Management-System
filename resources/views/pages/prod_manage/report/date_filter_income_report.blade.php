@extends('../layout.layout')

@section('title', 'Reports')

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-12 margin-top-20">
            <div class="d-inline-flex">
                <div class="p-2"><a href="/list-reports">Back</a></div>
                <div class="p-2"><h2>Income Report</h2></div>
            </div>

            <hr>
            <form action="/filter-date-income" method="POST" class="report px-20-30">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $start_date) }}" max="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-5">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $end_date) }}" max="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-2">
                        <label name="button"> </label>
                        <button type="submit" class="btn btn-success btn-block" name="button"><i class="glyphicon glyphicon-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 margin-top-20">
            @if(isset($incomes))
            <form action="/download-date-range-income-PDF" method="POST">
                @csrf
                <input type="hidden" name="start_date" class="form-control" value="{{ old('start_date', $start_date) }}">
                <input type="hidden" name="end_date" class="form-control" value="{{ old('end_date', $end_date) }}">
                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-download-alt"></i> Download Report</button>
            </form>
            @endif

            <hr>
            <div class="page-break report" id="report-summary">
                <div class="report-head">
                    <h1>{{ __( session('title') ) }} - Income Report</h1>
                    <strong>{{ old('start_date', $start_date) }} TILL DATE {{ old('end_date', $end_date) }} </strong>
                </div>
                <table class="table table-border report-table">
                    <thead>
                    <tr>
                        <th style="text-align: center">ID</th>
                        <th>Date</th>
                        <th>Created By </th>
                        <th>Note</th>
                        <th style="text-align: right">Amount (Rs)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalSum = 0;
                    @endphp
                    @if(isset($incomes))
                        @foreach($incomes as $income)
                            <tr>
                                <td style="text-align: center">{{$income->id}}</td>
                                <td class="text-left">{{$income->date}}</td>
                                <td class="text-left">{{$income->users->name}}</td>
                                <td class="text-left">{{$income->note}}</td>
                                <td class="text-right">{{number_format($income->price,2)}}</td>
                            </tr>
                            @php
                                $totalSum += $income->price;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-default text-center"><span class="glyphicon glyphicon-warning-sign"></span> Not found data!</div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                    <tfoot>
                    <tr class="text-right">
                        <td colspan="3"></td>
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
