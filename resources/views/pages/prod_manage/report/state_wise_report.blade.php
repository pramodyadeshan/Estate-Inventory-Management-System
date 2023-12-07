@extends('../layout.layout')

@section('title', 'Reports')

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-12 margin-top-20">
            <div class="d-inline-flex">
                <div class="p-2"><a href="/list-reports">Back</a></div>
                <div class="p-2"><h2>Estate Wise Report</h2></div>
            </div>
        </div>
        <div class="col-md-12 margin-top-20">

            <a href="/download-state-wise-PDF" class="btn btn-primary"><i class="glyphicon glyphicon-download-alt"></i> Download Report</a>

            <hr>
            <div class="page-break report" id="report-summary">
                <div class="report-head">
                    <h1>{{ __( session('title') ) }} - Estate Wise Report</h1>
                </div>
                <table class="table table-border report-table">
                    <thead>
                    <tr>
                        <th class="text-center" style="text-align: center">ID</th>
                        <th class="text-left">Add Date</th>
                        <th class="text-left">Estate Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($states))
                        @foreach($states as $state)
                            <tr>
                                <td class="text-center">{{$state->id}}</td>
                                <td class="text-left">{{ $state->created_at}}</td>
                                <td class="text-left">{{$state->state_name}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
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
