@extends('../layout.layout')

@section('title', 'Edit User Role')

@section('content')
<div class="contain">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default add-user-form">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Edit User Role</span>
                    </strong>
                    <small class="back-text-right">
                        <a href="/list-user-role" class="text-decoration-none">Back</a>
                    </small>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('edit-auth-user-role', $user_role_record->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input type="text" class="form-control" name="role_name" placeholder="Role Name" autofocus value="{{$user_role_record->role_name}}">
                            @error('role_name')
                            <div class="error-msg">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="group_level">Group Level</label>
                            <select class="form-control" name="group_level">
                                <option value="0" {{ $user_role_record->group_level == 0 ? 'selected':'' }}>Super Admin Level</option>
                                <option value="1" {{ $user_role_record->group_level == 1 ? 'selected': '' }}>Admin Level</option>
                                <option value="2" {{ $user_role_record->group_level == 2 ? 'selected': '' }}>User Level</option>
                            </select>
                            @error('group_level')
                            <div class="error-msg">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" {{ $user_role_record->status == 1 ? 'selected':'' }}>Active</option>
                                <option value="0" {{ $user_role_record->status == 0 ? 'selected': '' }}>Deactive</option>
                            </select>
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" name="add_user" class="btn btn-primary">Update User Role</button>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection
