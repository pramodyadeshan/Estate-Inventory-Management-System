@extends('../layout.layout')

@section('title', 'Add User Role')

@section('content')
<div class="contain">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default add-user-form">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Add User Role</span>
                    </strong>
                    <small class="back-text-right">
                        <a href="/list-user-role" class="text-decoration-none">Back</a>
                    </small>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{route('add-user-role')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" name="role_name" placeholder="Role Name">
                            @error('role_name')
                            <div class="error-msg">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Group Level</label>
                            <select class="form-control" name="group_level">
                                <option value="0">Super Admin Level</option>
                                <option value="1">Admin Level</option>
                                <option value="2">User Level</option>
                            </select>
                            @error('group_level')
                            <div class="error-msg">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                        <div class="form-group clearfix">
                            <button type="submit" name="add_user" class="btn btn-primary">Add User Role</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
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
