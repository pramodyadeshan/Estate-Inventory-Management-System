@extends('../layout.layout')

@section('title', 'System Setting')

@section('content')

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">

        @if(session('success'))
            <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
        @elseif(session('info'))
        <div class="alert alert-info text-center alert-msg"><strong>Info : {{session('info')}}!</strong></div>
        @endif

        <form class="form" action="/save-system-setting" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-heading clearfix">
                        <span class="glyphicon glyphicon-cog"></span>
                        <span>Change System Settings</span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <img class="img-circle img-size-4 cursor-pointer" src="{{asset('uploads/system-logo/').'/'.$system_data->logo }}" id="selectedImage" alt="profile" data-target="#view_logo" data-toggle="modal">

                            <div id="view_logo" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title text-left">System Logo</h4>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{asset('uploads/system-logo/').'/'.$system_data->logo}}" class="img-responsive" alt="gallery image" width="100%" height="200px">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h4 class="text-muted margin-bottom-20"><b>Logo image</b></h4>
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

                                <input type="file" class="form-control browse_img d-none" name="logo" id="browse_input" onchange="$('#profile_pic_selected_img').show();$('#profile_pic_remove_icon').removeClass('d-none'); $('#browse_img').hide();">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-heading clearfix">
                        <span class="glyphicon glyphicon-cog"></span>
                        <span>Change System & Footer Title</span>
                    </div>
                </div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 text-center">
                                <span class="glyphicon glyphicon-cog padding-top fs-60"></span>
                            </div>
                            <div class="col-md-10 d-inline">
                                <div class="col-md-12 margin-bottom-10">
                                    <label>Title</label>
                                    <input type="text" name="system_title" class="form-control" value="{{$system_data->title}}">
                                </div>
                                <div class="col-md-12 margin-bottom-10">
                                    <label>Footer Title ©</label>
                                    <input type="text" name="footer_title" class="form-control" value="{{$system_data->footer_title}}">
                                </div>
                            </div>
                        <div class="col-md-2 text-center">

                        </div>
                   </div>
                </div>
            </div>

            <div class="col-md-12 margin-bottom-10 no-padding">
                <button type="submit" class="btn btn-warning"> <span class="glyphicon glyphicon-ok-circle"></span> Save Change</button>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
@endsection
