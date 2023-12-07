@extends('../layout.layout')

@section('title', 'Edit User')

@section('content')

<div class="contain">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default add-user-form">
            <div class="panel-heading">
              <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Edit User</span>
             </strong>
             <small class="back-text-right">
                <a href="/list-users" class="text-decoration-none">Back</a>
             </small>
            </div>
            <div class="panel-body">
                <form method="post" action="/edit-auth-user/{{$user_data->id}}" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                      <label for="name">Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="{{$user_data->name}}">
                      @error('full_name')
                      <div class="error-msg">
                          <span class="text-danger">{{ $message }}</span>
                      </div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="username">Username<span class="text-danger">*</span></label>
                      @if(Auth()->user()->id == '1')
                        <input type="text" class="form-control" name="username" placeholder="Username" value="{{$user_data->username}}">
                      @else
                        <input type="text" class="form-control" name="username" placeholder="Username" disabled value="{{$user_data->username}}">
                      @endif
                      @error('username')
                      <div class="error-msg">
                          <span class="text-danger">{{ $message }}</span>
                      </div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="password">Password<span class="text-danger">*</span></label>
                      @if(Auth()->user()->id == '1')
                        <input type="text" class="form-control" name="password"  placeholder="Password reset for permission only super admin" value="">
                      @else
                        <input type="password" class="form-control" name="password"  placeholder="Password" value="123456" disabled>
                      @endif
                      @error('password')
                      <div class="error-msg">
                          <span class="text-danger">{{ $message }}</span>
                      </div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="level">User Role<span class="text-danger">*</span></label>
                    <select class="form-control" name="user_roles">
                        <option value="{{$user_data->role_id}}">{{$user_data->role->role_name}}</option>
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
                            <option value="{{$state->id}}" selected>{{$state->state_name}}</option>
                            @endforeach
                            @foreach($statesNotSelected as $stateNotSelected)
                            <option value="{{$stateNotSelected->id}}">{{$stateNotSelected->state_name}}</option>
                            @endforeach
                        </select>

                      <div class="state-msg">
                          <i class="text-danger">To see changes in this account, log out and log back in after updating</i>
                      </div>
                        @error('state_id')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="password">Status<span class="text-danger">*</span></label>
                    <select class="form-control" name="status">
                        <option value="1" {{ $user_data->status == 1 ? 'selected': '' }}>Active</option>
                        <option value="0" {{ $user_data->status == 0 ? 'selected': '' }}>Deactive</option>
                    </select>
                    @error('status')
                    <div class="error-msg">
                       <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                      @if($user_data->image)
                      <a href="#" class="text-info" data-toggle="modal" data-target="#profile_image{{$user_data->id}}">
                          <i class="glyphicon glyphicon-camera"></i> current image
                      </a>
                      <input type="hidden" name="current_image" value="{{$user_data->image}}">
                      @endif
                      <div id="profile_image{{$user_data->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">{{$user_data->name}}</h4>
                                  </div>
                                  <div class="modal-body">
                                      <img src="{{asset('uploads/user-profile-images/').'/'.$user_data->image}}" class="img-responsive" alt="gallery image" width="100%" height="200px">
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                              </div>

                          </div>
                      </div>

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
                    <button type="submit" class="btn btn-primary">Edit User</button>
                  </div>
              </form>

              @if(session('success'))
                <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
              @elseif(session('info'))
                <div class="alert alert-info text-center alert-msg"><strong>Info : {{session('info')}}!</strong></div>
              @endif
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
    </div>
  </div>
</div>
@endsection
