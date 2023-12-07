@extends('../layout.layout')

@section('title', 'User Role')

@section('content')

<div class="col-md-12">
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>User Roles</span>
       </strong>
         <a href="/view-user-role" class="btn btn-info pull-right btn-sm"> Add New Group</a>
      </div>
       <div class="panel-body">
        <table class="table table-bordered report-table">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Role Name</th>
              <th class="text-center" style="width: 20%;">Group Level</th>
              <th class="text-center" style="width: 15%;">Status</th>
              <th class="text-center" style="width: 140px;">Actions</th>
            </tr>
          </thead>
          <tbody>

          @if(count($user_roles) > 0)
          @php
            $i = 1;
          @endphp
            @foreach($user_roles as $user_role)
            <tr>
                <td class="text-center">{{ $i++ }}</td>
                <td>{{ $user_role->role_name }}</td>
                <td class="text-center">
                    @if($user_role->group_level === 0)
                    <span class="label label-danger">{{ __('Super Admin Level') }}</span>
                    @elseif($user_role->group_level === 1)
                    <span class="label label-info">{{ __('Admin Level') }}</span>
                    @elseif($user_role->group_level === 2)
                    <span class="label label-info">{{ __('User Level') }}</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($user_role->status)
                        <span class="label label-success">{{ __('Active') }}</span>
                    @else
                        <span class="label label-danger">{{ __('Deactive') }}</span>
                    @endif
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        <a href="/edit-user-role/{{ $user_role->id }}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a data-toggle="tooltip" title="Remove">
                            <button type="button" class="btn btn-sm btn-danger" data-target="#deleteModal{{ $user_role->id }}" data-toggle="modal">
                                <i class="glyphicon glyphicon-remove"></i>
                            </button>
                        </a>
                    </div>
                </td>
            </tr>

            <div class="modal fade" id="deleteModal{{ $user_role->id }}">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Remove User Role</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <b>Are you sure you want to delete?</b>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">No</button>
                          <a href="/delete-user-role/{{ $user_role->id }}" type="button" class="btn btn-danger">Yes</a>
                      </div>
                  </div>
              </div>
            </div>
            @endforeach
            @else
              <tr>
                  <td class="text-center" colspan="5">
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

</div>
@endsection
