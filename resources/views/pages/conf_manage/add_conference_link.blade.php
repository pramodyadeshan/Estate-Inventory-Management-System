@extends('../layout.layout')

@section('title', 'Add Conferece Link')

@section('content')

<div class="contain">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default add-user-form">
            <div class="panel-heading">
              <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Add Conferece Link</span>
             </strong>
             <small class="back-text-right">
                <a href="/list-conference" class="text-decoration-none">Back</a>
             </small>
            </div>
            <div class="panel-body">
                <form method="post" action="/add-auth-conference" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                    <label for="title">Title<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Title">
                    @error('title')
                    <div class="error-msg">
                       <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                      <label for="link">Conference Link<span class="text-danger">*</span></label>
                      <textarea class="form-control no-size" placeholder="Conference Link" name="link" rows="5"></textarea>
                      @error('link')
                      <div class="error-msg">
                          <span class="text-danger">{{ $message }}</span>
                      </div>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="state_name">Invite Users<span class="text-danger">*</span></label>
                    <select class="form-control select2" multiple="multiple" name="users[]" id="users">
                        <option value="0">All Users</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    @error('users')
                    <div class="error-msg">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="password">Status<span class="text-danger">*</span></label>
                    <select class="form-control" name="status">
                        <option value="1">Publish</option>
                        <option value="0">Unpublish</option>
                    </select>
                    @error('status')
                    <div class="error-msg">
                       <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                  </div>
                  <div class="form-group clearfix">
                    <button type="submit" class="btn btn-primary">Add Link</button>
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
