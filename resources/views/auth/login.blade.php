
<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
  </head>
  <body>
    <div class="container bg-white">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="login-form">
            <div class="text-center">
              <h1>{{ __('Login Panel') }}</h1>
              <h4>{{ __('Inventory Management System') }}</h4>
            </div>
            <form method="POST" action="{{route('login')}}" class="clearfix">
              @csrf
              <div class="form-group">
                    <label for="username" class="control-label">{{ __('Username') }}</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username">
              </div>
              <div class="form-group">
                    <label for="Password" class="control-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
              </div>
              <div class="form-group">

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-danger">
                    {{ __('Login') }}
                </button>
              </div>
            </form>

            @if($errors->any())
            <div class="login-alert" role="alert">
                @error('username')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                @error('password')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                @error('deactivateErr')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            @endif

          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
</body>
</html>
