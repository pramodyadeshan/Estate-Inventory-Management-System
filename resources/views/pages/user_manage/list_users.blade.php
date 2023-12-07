@extends('../layout.layout')

@section('title', 'User Manage')

@section('content')

<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Users</span>
        </strong>
          <a href="/add-user" class="btn btn-info pull-right">Add New User</a>
        </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped report-table">
          <thead>
            <tr>
              <th style="width: 4%;" class="text-center" style="width: 50px;">#</th>
              <th style="width: 15%;">Name </th>
              <th style="width: 30%;">State Name </th>
              <th style="width: 12%;">Username</th>
              <th class="text-left" style="width: 10%;">User Role</th>
              <th class="text-center" style="width: 10%;">Status</th>
              <th style="width: 10%;">Last Login</th>
              <th class="text-center" style="width: 10%;">Actions</th>
            </tr>
          </thead>
          <tbody>
          @if(count($users) > 0)
              @php
                $i = 1;
              @endphp
              @foreach ($users as $user)
                @if(Auth()->user()->id != $user->id && $user->id !== 1 || Auth()->user()->id == 1)
                  <tr>
                      <td class="text-center">{{$i++}}</td>
                      <td>
                          @if($user->image)
                          <img src="{{asset('uploads/user-profile-images/').'/'.$user->image}}" class="avatar-user-profile" data-toggle="modal" data-target="#profile_image{{$user->id}}">
                          @else
                          <img src="{{asset('uploads/user-profile-images/').'/1701108377.png' }}" class="avatar-user-profile" data-toggle="modal" data-target="#profile_image{{$user->id}}">
                          @endif
                          {{$user->name}}
                      </td>
                      <td>
                          @php
                            $stateIds = json_decode($user->state_id, true);
                          @endphp

                          @foreach($stateIds as $stateId)
                          <label class="label label-success state-label"><i class="glyphicon glyphicon-ok" class="avatar-user-profile"></i> {{ $states_data->where('id', $stateId)->first()->state_name }}</label>
                          @endforeach
                      </td>
                      <td>{{$user->username}}</td>
                      <td class="text-left"><b>{{$user->role->role_name}}</b></td>
                      <td class="text-center">
                      @if($user->status)
                          <span class="label label-success">{{ __('Active') }}</span>
                      @else
                          <span class="label label-danger">{{ __('Deactive') }}</span>
                      @endif
                      </td>
                      <td>{{$user->updated_at ? $user->updated_at : 'N/A'}}</td>
                      <td class="text-center">
                          <div class="btn-group">
                              @if(Auth()->user()->id != $user->id)
                              <a href="/user-chat/{{ $user->id }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Message">
                                  <i class="glyphicon glyphicon-envelope"></i>
                              </a>
                              @endif
                              <a href="/edit-user/{{ $user->id }}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                  <i class="glyphicon glyphicon-pencil"></i>
                              </a>
                              <a href="#" data-toggle="tooltip" title="Remove">
                                  <button type="button" class="btn btn-sm btn-danger" data-target="#deleteModal{{ $user->id }}" data-toggle="modal">
                                      <i class="glyphicon glyphicon-remove"></i>
                                  </button>
                              </a>
                          </div>
                      </td>
                  </tr>

                  <div id="profile_image{{$user->id}}" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">{{$user->name}}</h4>
                              </div>
                              <div class="modal-body">
                                  <img src="{{asset('uploads/user-profile-images/').'/'.$user->image}}" class="img-responsive" alt="gallery image" width="100%" height="200px">
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                          </div>

                      </div>
                  </div>

                  <div class="modal fade" id="deleteModal{{ $user->id }}">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Remove User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <b>Are you sure you want to delete?</b>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">No</button>
                                  <a href="/delete-user/{{ $user->id }}" type="button" class="btn btn-danger">Yes</a>
                              </div>
                          </div>
                      </div>
                  </div>
                @endif
              @endforeach
          @endif
        </tbody>
      </table>
          @if(session('success'))
            <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
          @elseif(session('error'))
            <div class="alert alert-danger text-center alert-msg"><strong>Error : {{session('error')}}!</strong></div>
          @endif
      </div>
      </div>

        <nav aria-label="...">
            <ul class="pagination">
                @if($users->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev" tabindex="-1">Previous</a>
                </li>
                @endif

                @for ($i = 1; $i <= $users->lastPage(); $i++)
                @if ($i == $users->currentPage())
                <li class="page-item active">
                    <a class="page-link" href="{{ $users->url($i) }}">{{ $i }} <span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a></li>
                @endif
                @endfor

                @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">Next</a>
                </li>
                @else
                <li class="page-item disabled">
                    <a class="page-link" href="#">Next</a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
  </div>
</div>
@endsection
