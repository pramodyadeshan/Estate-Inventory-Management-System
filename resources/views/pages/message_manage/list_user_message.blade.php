@extends('../layout.layout')

@section('title', 'Messages')

@section('content')

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span>
                        @if($user_data->image)
                          <img src="{{asset('uploads/user-profile-images/').'/'.$user_data->image}}" class="avatar-user-profile">
                          @else
                          <img src="{{asset('uploads/user-profile-images/').'/1701108377.png' }}" class="avatar-user-profile">
                        @endif
                    </span>
                    <label>{{ $user_data->name}}</label>
                </strong>
            </div>
            <div class="panel-body message-body">
                <div class="col-md-12">
                    @if(count($chat_history)>0)
                        @foreach($chat_history as $chat_histories)
                            @if($chat_histories->receiver_id == $user_data->id)
                                <div class="row margin-top-10">
                                    <div class="col-md-7"></div>
                                    <div class="col-md-5 main-receiver-message-box">
                                        <div class="row sub-message-box">
                                            <div class="col-md-1">
                                                <label class="receiver_icon">Y</label>
                                            </div>
                                            <div class="col-md-11">
                                                <span class="message-div">{{$chat_histories->message}}</span>
                                                <br>
                                                <small class="pull-right">{{$chat_histories->date_time}} <i class="glyphicon glyphicon-ok"></i></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row margin-top-10">
                                    <div class="col-md-5 main-sender-message-box">
                                        <div class="row sub-message-box">
                                            <div class="col-md-1 text-center">
                                                @if($user_data->image)
                                                    <img src="{{asset('uploads/user-profile-images/').'/'.$user_data->image}}" class="avatar-user-profile">
                                                @else
                                                    <img src="{{asset('uploads/user-profile-images/').'/1701108377.png' }}" class="avatar-user-profile">
                                                @endif
                                            </div>
                                            <div class="col-md-11">
                                                <span class="message-div">{{$chat_histories->message}}</span>
                                                <br>
                                                <small class="pull-right">{{$chat_histories->date_time}} <i class="glyphicon glyphicon-ok"></i></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7"></div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h4 class="text-muted">
                                    <img src="{{asset('uploads/product-images/').'/no-message.jpg' }}" class="img-responsive text-center no-msg">
                                    <h2 class="text-center text-muted">Not started conversation yet</h2>
                                </h4>
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                    @endif
                </div>
            </div>
            <div class="panel-footer">
                <form action="/send-message/{{$user_data->id}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <textarea placeholder="Enter Message..." class="form-control msg-textarea" name="message"></textarea>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success btn-block send-btn"><i class="glyphicon glyphicon-send"></i> Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
