@extends('../layout.layout')

@section('title', 'Edit Expenditure')

@section('content')

<div class="row margin-top">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Edit Expenditure</span>
                </strong>
                <small class="back-text-right">
                    <a href="/list-expend" class="text-decoration-none">Back</a>
                </small>
            </div>
            <div class="panel-body">
                <form method="POST" action="/edit-expend/{{$edit_expend_data->id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="expend_date">
                            Date
                        </label>
                        <input type="date" class="form-control" name="date" value="{{$edit_expend_data->date}}" max="{{ date('Y-m-d') }}">
                        @error('expend_date')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="note">
                            Note
                        </label>
                        <textarea name="note" cols="30" rows="5" placeholder="Type about expenditure note" class="form-control">{{$edit_expend_data->note}}</textarea>
                        @error('note')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="amount">
                            Amount (Rs)
                        </label>
                        <input type="text" class="form-control" name="amount" value="{{$edit_expend_data->price}}">
                        @error('amount')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Income</button>
                </form>

                @if(session('success'))
                    <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
                @elseif(session('info'))
                    <div class="alert alert-info text-center alert-msg"><strong>Info : {{session('info')}}!</strong></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>

@endsection
