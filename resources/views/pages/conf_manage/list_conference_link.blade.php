@extends('../layout.layout')

@section('title', 'Conferences Manage')

@section('content')

<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Conferences</span>
              <a href="/add-conference-form" class="btn btn-info pull-right">Add New Link</a>
        </strong>
        </div>
      <div class="panel-body">
          @if(count($conferences) > 0)
              @php
              $i = 1;
              @endphp
              @foreach($conferences as $conference)
                  <div class="row link-div">
                      <div class="col-md-10">
                          <h4><b>{{ $conference->title }}</b></h4>
                          <span class="text-dark">{{ $conference->created_at }}</span> <br />
                          <span class="text-muted">Created by {{ $conference->user->name }}</span>
                      </div>
                      <div class="col-md-2">
                          <a href="{{ $conference->link }}" target="_blank" class="btn btn-primary btn-block margin-top-20 link-btn"><i class="glyphicon glyphicon-send"></i> Join</a>
                      </div>
                  </div>
              @endforeach
          @else
            <div class="col-md-12 text-danger text-center"> <i class="glyphicon glyphicon-warning-sign"></i> Data not found!</div>
          @endif
        </tbody>
      </table>
      </div>
      </div>

        <nav aria-label="...">
            <ul class="pagination">
                @if($conferences->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $conferences->previousPageUrl() }}" rel="prev" tabindex="-1">Previous</a>
                </li>
                @endif

                @for ($i = 1; $i <= $conferences->lastPage(); $i++)
                @if ($i == $conferences->currentPage())
                <li class="page-item active">
                    <a class="page-link" href="{{ $conferences->url($i) }}">{{ $i }} <span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $conferences->url($i) }}">{{ $i }}</a></li>
                @endif
                @endfor

                @if ($conferences->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $conferences->nextPageUrl() }}" rel="next">Next</a>
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
