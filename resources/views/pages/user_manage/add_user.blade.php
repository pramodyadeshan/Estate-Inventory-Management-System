@extends('../layout.layout')

@section('title', 'Add New User')

@section('content')

<div class="contain">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default add-user-form">
            <div class="panel-heading">
              <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Add New User</span>
             </strong>
             <small class="back-text-right">
                <a href="/list-users" class="text-decoration-none">Back</a>
             </small>
            </div>
            <div class="panel-body">
                <form method="post" action="/add-auth-user" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                    <label for="name">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="full_name" placeholder="Full Name">
                    @error('full_name')
                    <div class="error-msg">
                       <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                      <label for="username">Username<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="username" placeholder="Username">
                      @error('username')
                      <div class="error-msg">
                          <span class="text-danger">{{ $message }}</span>
                      </div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="password">Password<span class="text-danger">*</span></label>
                      <input type="password" class="form-control" name="password"  placeholder="Password">
                      @error('password')
                      <div class="error-msg">
                          <span class="text-danger">{{ $message }}</span>
                      </div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="level">User Role<span class="text-danger">*</span></label>
                    <select class="form-control" name="user_roles">
                            <option value="">Select User Role</option>
                            @foreach($user_role_records as $user_role_data)
                                <option value="{{$user_role_data->id}}">{{$user_role_data->role_name}}</option>
                            @endforeach
                    </select>
                    @error('user_roles')
                    <div class="error-msg">
                       <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="state_name">State Name<span class="text-danger">*</span></label>
                    <select class="form-control select2" multiple="multiple" name="state_id[]">
                      @foreach($states as $state)
                      <option value="{{$state->id}}">{{$state->state_name}}</option>
                      @endforeach
                    </select>
                    @error('state_id')
                    <div class="error-msg">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="password">Status<span class="text-danger">*</span></label>
                    <select class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                    </select>
                    @error('status')
                    <div class="error-msg">
                       <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>

                      <a href="#" id="remove_icon" class="d-none" onclick="document.getElementById('browse_input').value = '';$('#selected_img').hide(); $('#browse_img').show();$('#remove_icon').addClass('d-none');" >
                          <i class="glyphicon glyphicon-trash"></i>
                      </a>

                    <div class="col-md-12" id="browse_img" onclick="document.getElementById('browse_input').click();">
                      <span><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Choose image</span>
                    </div>

                    <div class="col-md-12" id="selected_img" onclick="document.getElementById('browse_input').click();">
                      <span><i class="glyphicon glyphicon-ok"></i>&nbsp; Selected image</span>
                    </div>

                    <input type="file" class="form-control browse_img d-none" name="profile_picture" id="browse_input" onchange="$('#selected_img').show();$('#remove_icon').removeClass('d-none'); $('#browse_img').hide();">

                  </div>
                  <div class="form-group clearfix">
                    <button type="submit" class="btn btn-primary">Add User</button>
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
</div>
@endsection
