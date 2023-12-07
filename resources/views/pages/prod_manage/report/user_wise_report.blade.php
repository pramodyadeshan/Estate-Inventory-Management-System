@extends('../layout.layout')

@section('title', 'Reports')

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-12 margin-top-20">
            <div class="d-inline-flex">
                <div class="p-2"><a href="/list-reports">Back</a></div>
                <div class="p-2"><h2>User Wise Report</h2></div>
            </div>
        </div>
        <div class="col-md-12 margin-top-20">

            <a href="/download-user-wise-PDF" class="btn btn-primary"><i class="glyphicon glyphicon-download-alt"></i> Download Report</a>

            <hr>
            <div class="page-break report" id="report-summary">
                <div class="report-head">
                    <h1>{{ __( session('title') ) }} - User Wise Report</h1>
                </div>
                <table class="table table-border report-table">
                    <thead>
                    <tr>
                        <th class="text-center" style="text-align: center">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">State Name</th>
                        <th class="text-left">User Role</th>
                        <th class="text-left">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($users))
                        @foreach($users as $user)
                            @if($user->id !== 1)
                                <tr>
                                    <td class="text-center">{{$user->id}}</td>
                                    <td class="text-left">{{$user->name}}</td>
                                    <td class="text-left">
                                        @php
                                        $stateIds = json_decode($user->state_id, true);
                                        @endphp

                                        @foreach($stateIds as $stateId)
                                        <label class="label label-success state-label"><i class="glyphicon glyphicon-ok" class="avatar-user-profile"></i> {{ $states_data->where('id', $stateId)->first()->state_name }}</label>
                                        @endforeach
                                    </td>
                                    <td class="text-left">{{$user->role->role_name}}</td>
                                    <td class="text-left">{{$user->status == 1 ? 'Active' : 'Deactive'}}</td>
                                </tr>
                            @endif
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
