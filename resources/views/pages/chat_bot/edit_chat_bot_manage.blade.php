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
                    <span>Edit Chat Bot Data</span>
                </strong>
                <small class="back-text-right">
                    <a href="/manage-chat-bot" class="text-decoration-none">Back</a>
                </small>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{url('edit-auth-chat-bot', $chat_bot_record->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="exp_date">Keyword<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="keyword" value="{{$chat_bot_record->keyword}}">
                        @error('keyword')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                    <label for="exp_date">Response Message<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="response" value="{{$chat_bot_record->response}}">
                        @error('response')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Chat Bot Data</button>
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
