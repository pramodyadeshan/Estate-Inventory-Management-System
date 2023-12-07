@extends('../layout.layout')

@section('title', 'Incomes')

@section('content')

<div class="row">
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-box clearfix" data-title="Calculated from this month first day to current day" data-toggle="tooltip">
                    <div class="panel-icon pull-left bg-green">
                        <i class="glyphicon glyphicon-usd"></i>
                    </div>
                    <div class="panel-value pull-right padding-top-25">
                        <h4 class="margin-top text-muted"><b>Rs. {{ number_format($sumOfThisMonthIncome) }}</b></h4>
                        <p class="text-muted">Current Month Income</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-box clearfix" data-title="Calculated from this year first day to last month last day" data-toggle="tooltip">
                    <div class="panel-icon pull-left bg-blue2">
                        <i class="glyphicon glyphicon-usd"></i>
                    </div>
                    <div class="panel-value pull-right padding-top-25">
                        <h4 class="margin-top text-muted"><b>Rs. {{ number_format($sumOfPreMonthIncome) }}</b></h4>
                        <p class="text-muted">Pre-Month Income</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New Income</span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="POST" action="/add-auth-income" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="income_date">
                            Date
                        </label>
                        <input type="date" class="form-control" name="income_date" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                        @error('income_date')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="note">
                            Note
                        </label>
                        <textarea name="note" cols="30" rows="5" placeholder="Type about income note" class="form-control" autofocus="autofocus"></textarea>
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
                        <input type="text" class="form-control" name="amount" value="0">
                        @error('amount')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add Income</button>
                </form>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
        @endif
    </div>
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>All Incomes</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover report-table">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th style="width: 12%;">Date</th>
                        <th>Note</th>
                        <th style="width: 20%;">Amount (Rs)</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($income_data) > 0)
                        @php
                            $i = 1;
                        @endphp
                        @foreach($income_data as $income_data_one)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td>{{$income_data_one->date}}</td>
                            <td>{{$income_data_one->note}}</td>
                            <td>{{ number_format($income_data_one->price,2) }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="/edit-income-form/{{$income_data_one->id}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a data-toggle="tooltip" title="Remove">
                                        <button type="button" class="btn btn-sm btn-danger" data-target="#deleteModal{{$income_data_one->id}}" data-toggle="modal">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteModal{{$income_data_one->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Remove Income</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <b>Are you sure you want to delete?</b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">No</button>
                                        <a href="/delete-income/{{$income_data_one->id}}" type="button" class="btn btn-danger">Yes</a>
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
        <nav>
            <ul class="pagination">
                @if($income_data->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $income_data->previousPageUrl() }}" rel="prev" tabindex="-1">Previous</a>
                </li>
                @endif

                @for ($i = 1; $i <= $income_data->lastPage(); $i++)
                @if ($i == $income_data->currentPage())
                <li class="page-item active">
                    <a class="page-link" href="{{ $income_data->url($i) }}">{{ $i }} <span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $income_data->url($i) }}">{{ $i }}</a></li>
                @endif
                @endfor

                @if ($income_data->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $income_data->nextPageUrl() }}" rel="next">Next</a>
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

@endsection
