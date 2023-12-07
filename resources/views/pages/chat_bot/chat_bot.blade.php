@extends('../layout.layout')

@section('title', 'Incomes')

@section('content')

<div class="row">
    <div class="col-md-12">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Chat with the Bot</span>
                </strong>
            </div>
            <div class="panel-body">

            
                        <label>
                        Bot Response :
                        </label>
                        <br><br>
                        @if(isset($botResponse))
                        <p>Bot: {{ $botResponse }}</p>
                        @endif
                        <br>
                <form method="POST" action="/chat" enctype="multipart/form-data">
                @csrf

                    <div class="form-group">
                        <label for="note">
                        Your message:
                        </label>
                        <input type="text" name="message" id="message" class="form-control" required>
                        @error('note')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>

                    </form>
                        
                    
                
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
        @endif
    </div>
    
</div>

@endsection
