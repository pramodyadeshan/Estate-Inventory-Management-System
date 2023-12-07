@extends('../layout.layout')

@section('title', 'Profile Setting')

@section('content')

@if(session('success'))
    <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-heading clearfix">
                    <span class="glyphicon glyphicon-camera"></span>
                    <span>Change My photo</span>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img class="img-circle img-size-4" src="{{asset('uploads/user-profile-images/').'/'.Auth()->user()->image}}" alt="profile">
                    </div>
                    <div class="col-md-8">
                        <form class="form" action="/account-setting/{{'img'}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h4 class="text-muted margin-bottom-20"><b>Profile Picture</b></h4>
                            <div class="form-group">
                                <div class="col-md-12" id="browse_img" onclick="document.getElementById('browse_input').click();">
                                    <span><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Choose image</span>
                                </div>
                                <div class="col-md-12 margin-bottom-6">
                                    <div class="row margin-bottom-10">
                                        <div class="col-md-10" id="profile_pic_selected_img" onclick="document.getElementById('browse_input').click();">
                                            <span><i class="glyphicon glyphicon-ok"></i>&nbsp; Selected image</span>
                                        </div>
                                        <div class="col-md-2 d-none" id="profile_pic_remove_icon" onclick="document.getElementById('browse_input').value = '';$('#profile_pic_selected_img').hide(); $('#browse_img').show();$('#profile_pic_remove_icon').addClass('d-none');">
                                                <i class="glyphicon glyphicon-trash"></i>
                                        </div>
                                    </div>
                                </div>

                                <input type="file" class="form-control browse_img d-none" name="profile_picture" id="browse_input" onchange="$('#profile_pic_selected_img').show();$('#profile_pic_remove_icon').removeClass('d-none'); $('#browse_img').hide();">

                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-warning">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <span class="glyphicon glyphicon-edit"></span>
                        <span>Edit My Account</span>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="account-setting/{{'name'}}" class="clearfix">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="name" class="form-control" name="profile_name" value="{{Auth()->user()->name}}">
                            </div>
                            <div class="form-group margin-top-20">
                                <label for="status" class="control-label">Status</label> <br />
                                <span for="status-title" class="label label-{{Auth()->user()->status == '1' ? 'success' : 'danger'}} label-lg status-title">{{Auth()->user()->status == '1' ? 'Activated' : 'Deactivated'}}</span>
                            </div>
                            <div class="form-group clearfix margin-top-20">
                                <button type="submit" name="update" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <span class="glyphicon glyphicon-asterisk"></span>
                        <span>Change Password</span>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="account-setting/{{'password'}}" class="clearfix">
                            @csrf
                            <div class="form-group">
                                <label for="newPassword" class="control-label">New password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New password">
                            </div>

                            <div class="form-group">
                                <label for="reNewPassword" class="control-label">Re-type new password</label>
                                <input type="password" class="form-control" name="re_new_password" id="re_new_password" placeholder="Re-type new password">
                                <div id="password_match_message" class="text-success margin-top-10"></div>
                            </div>
                            <div class="form-group clearfix">
                                <button type="submit" name="update" title="change password" class="btn btn-danger">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
