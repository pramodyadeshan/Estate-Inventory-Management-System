@extends('../layout.layout')

@section('title', 'All Divisions')

@section('content')

<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New Division</span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="POST" action="/add-divisions" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="exp_date">Division Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="division_name" placeholder="Division Name">
                        @error('division_name')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                       <label for="exp_date">Estate Name<span class="text-danger">*</span></label>
                       <select class="form-control" name="state">
                           <option value="">Select Estate Name</option>
                           @foreach($states as $state)
                           <option value="{{$state->id}}">{{$state->state_name}}</option>
                           @endforeach
                       </select>
                       @error('state')
                       <div class="error-msg">
                           <span class="text-danger">{{ $message }}</span>
                       </div>
                       @enderror
                   </div>

                    <button type="submit" class="btn btn-primary">Add Division</button>
                </form>

                @if(session('success'))
                <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>All Divisions</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover report-table">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Divisions</th>
                        <th class="text-center" style="width: 40%;">Estates</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($list_divisions) > 0)
                            @php
                                $i = 1;
                            @endphp
                            @foreach($list_divisions as $list_division)
                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td>{{$list_division->division_name}}</td>
                                <td>{{$list_division->state->state_name}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="/edit-division/{{$list_division->id}}"
                                           class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a data-toggle="tooltip" title="Remove">
                                            <button type="button" class="btn btn-sm btn-danger" data-target="#deleteModal{{ $list_division->id }}" data-toggle="modal">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal{{$list_division->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Remove Divisions</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <b>Are you sure you want to delete?</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">No</button>
                                            <a href="/delete-division/{{$list_division->id}}" type="button" class="btn btn-danger">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="3">
                                <div class="text-danger text-center"> <i class="glyphicon glyphicon-warning-sign"></i> Data not found!</div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
