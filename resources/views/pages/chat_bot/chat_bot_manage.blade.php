@extends('../layout.layout')

@section('title', 'Manage Chat Bot')

@section('content')

<div class="row">
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New Chat Bot Data</span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="POST" action="/add-chat-bots" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label for="exp_date">Chat Keyword<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="keyword" placeholder="Chat Keyword">
                        @error('keyword')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                    <label for="exp_date">Chat Response<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="response" placeholder="Chat Response Message">
                        @error('response')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Add Chat Bot Data</button>
                </form>

                @if(session('success'))
                <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>All Chat Bot Data</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table report-table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>Keywords</th>
                        <th class="text-center" style="width: 40%;">Responses</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($list_chat_bots) > 0)
                            @foreach($list_chat_bots as $list_chat_bot)
                            <tr>
                                <td class="text-center">{{$list_chat_bot->id}}</td>
                                <td>{{$list_chat_bot->keyword}}</td>
                                <td>{{$list_chat_bot->response}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="/update-chat-bot/{{$list_chat_bot->id}}"
                                           class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a data-toggle="tooltip" title="Remove">
                                            <button type="button" class="btn btn-sm btn-danger" data-target="#deleteModal{{ $list_chat_bot->id }}" data-toggle="modal">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal{{$list_chat_bot->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Remove Chat Bot Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <b>Are you sure you want to delete?</b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">No</button>
                                            <a href="/delete-chat-bot/{{$list_chat_bot->id}}" type="button" class="btn btn-danger">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="3">
                                <div class="text-danger text-center"> <i class="glyphicon glyphicon-warning-sign"></i> Data not found!</div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
