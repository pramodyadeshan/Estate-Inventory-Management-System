<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Inventory Management System')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('uploads/system-logo/').'/'.session('logo') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker3.min.css') }}" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <!--Input tag-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  </head>
  <body>
    <header id="header">
      <div class="logo pull-left"> {{ __( session('title') ) }}</div>
      <div class="header-content">
      <div class="header-date pull-left">
        <strong id="ct5"></strong>
      </div>
      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
            @if($Allconferences->unread == 1)
            <li class="profile">
                <a href="/list-conference" data-title="Conference Link" class="toggle top-user-message" aria-expanded="false">
                    <i class="glyphicon glyphicon-link"></i> <span class="">{{ $Allconferences->unread == 1 ? '1' : '' }}</span>
                </a>
            </li>
            @endif
            <li class="profile">

                <a href="#" data-toggle="dropdown" class="toggle top-user-message" aria-expanded="false">
                    <i class="glyphicon glyphicon-envelope"></i> <span class="">{{ Auth::user()->unread_message == 1 ? '1' : '' }}</span>
                </a>
                <ul class="dropdown-menu">
                    @foreach($allUsers as $user)
                        @if(Auth::user()->id !== $user->id)
                        <li>
                            <a href="/unread-message/{{$user->id}}" title="edit account">
                                <i class="glyphicon glyphicon-user"></i>
                                {{$user->name}} <span class="badge">{{ $user->id == Auth::user()->msg_sender_id && Auth::user()->unread_message == 1 ? '1' : '' }}</span>
                            </a>
                        </li>
                        @endif
                    @endforeach

                </ul>
            </li>

            <li class="profile">
                @php
                    //i already define session as 'states' and assign user table's state_id json array data.
                    //this code session included array data get to variable and it each one each check and get data from state table
                    //finally, select option show state id and state name.

                    $selectedStateIds = json_decode(Session::get('states', '[]'), true);
                    $states = \App\Models\State::whereIn('id', $selectedStateIds)->get();
                    $current_state = Auth::user()->current_state;
                @endphp
                <form action="/switch-state" method="POST">
                    @csrf
                    <select class="form-control navbar-state" name="state_id" onchange="$('#state_btn').click()" >
                        @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ $current_state == $state->id ? 'selected' : '' }}>{{ $state->state_name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="d-none" id="state_btn">Click</button>
                </form>
            </li>
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <img src="{{asset('uploads/user-profile-images/').'/'.Auth::user()->image}}" alt="user-image" class="img-circle img-inline">
              <span>{{ Auth::user()->name }} <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
            @if(Auth::user()->id == 1)
            <li>
                <a href="/system-settings" title="edit account">
                    <i class="glyphicon glyphicon-wrench"></i>
                    System Settings
                </a>
            </li>
            @endif
            <li>
                <a href="/settings" title="edit account">
                    <i class="glyphicon glyphicon-cog"></i>
                    Settings
                </a>
            </li>
             <li class="last">
                 <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                     <i class="glyphicon glyphicon-off"></i> {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div class="sidebar">
        @include('layout.menu')

    </div>

    <div class="page">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    @if (session('showFirstLoginModal'))

    <div id="low_stock_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Lowest Stock Products</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-condensed report-table">
                        <thead>
                        <tr>
                            <th class="text-center" style="width:10%;">#</th>
                            <th style="width:40%;">Product Name</th>
                            <th class="text-center text-danger" style="width:20%;">Total Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lowest_stock_products) > 0)
                        @php
                        $i = 1;
                        @endphp
                        @foreach($lowest_stock_products as $lowest_stock_product)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td>{{$lowest_stock_product->name}}</td>
                            <td class="text-center text-danger" style="font-size: 18px;"><b>{{$lowest_stock_product->qty}}</b></td>
                        </tr>
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
                <div class="modal-footer">
                    <a href="/lowest-product" type="button" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-search"></i> See All</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <script>
        // Show the first login modal on page load
        window.onload = function() {
            $('#low_stock_modal').modal();
        };
    </script>
    @endif

    <script>
        $('.select2').select2({
            data: [],
            tags: true,
            maximumSelectionLength: 10,
            tokenSeparators: [',', ' '],
            placeholder: "Select or type state name",
        });
    </script>

    @include('layout.footer')

</body>
</html>
