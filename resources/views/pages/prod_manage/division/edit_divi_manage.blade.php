@extends('../layout.layout')

@section('title', 'Edit Division')

@section('content')

<div class="row margin-top">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Edit Division</span>
                </strong>
                <small class="back-text-right">
                    <a href="/divi-manage" class="text-decoration-none">Back</a>
                </small>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{url('edit-auth-division', $division_record->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="exp_date">Division Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="division_name" value="{{$division_record->division_name}}">
                        @error('division_name')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                       <label for="exp_date">Estate Name<span class="text-danger">*</span></label>
                       <select class="form-control" name="division">
                           @foreach($states as $state)
                           <option value="{{$state->id}}" {{$state->id == $division_record->state_id ? 'Selected' : ''}}>{{$state->state_name}}</option>

                           @endforeach
                       </select>
                       @error('division')
                       <div class="error-msg">
                           <span class="text-danger">{{ $message }}</span>
                       </div>
                       @enderror
                   </div>
                    <button type="submit" class="btn btn-primary">Update Division</button>
                </form>

                @if(session('success'))
                <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>

@endsection
