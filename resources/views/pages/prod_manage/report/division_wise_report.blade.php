@extends('../layout.layout')

@section('title', 'Reports')

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-12 margin-top-20">
            <div class="d-inline-flex">
                <div class="p-2"><a href="/list-reports">Back</a></div>
                <div class="p-2"><h2>Division Wise Report</h2></div>
            </div>
        </div>
        <div class="col-md-12 margin-top-20">

            <a href="/download-division-wise-PDF" class="btn btn-primary"><i class="glyphicon glyphicon-download-alt"></i> Download Report</a>

            <hr>
            <div class="page-break report" id="report-summary">
                <div class="report-head">
                    <h1>{{ __( session('title') ) }} - Division Wise Report</h1>
                </div>
                <table class="table table-border report-table">
                    <thead>
                    <tr>
                        <th class="text-center" style="text-align: center">ID</th>
                        <th class="text-left">Add Date</th>
                        <th class="text-left">Estate Name</th>
                        <th class="text-left">Division Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($divisions))
                        @foreach($divisions as $division)
                            <tr>
                                <td class="text-center">{{$division->id}}</td>
                                <td class="text-left">{{ $division->created_at}}</td>
                                <td class="text-left">{{$division->state->state_name}}</td>
                                <td class="text-left">{{$division->division_name}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">
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
