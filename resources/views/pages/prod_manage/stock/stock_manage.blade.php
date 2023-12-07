@extends('../layout.layout')

@section('title', 'Stock Management')

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Issue Product From Stock</span>
                @if(session('success'))
                    <span class="label label-success" id="stock_save_msg">{{session('success')}}</span>
                @endif
            </strong>
        </div>
        <div class="panel-body">
            <form method="POST" action="/add-stock" enctype="multipart/form-data">
                @csrf
                    <table class="table table-bordered add-stock-table">
                        <thead>
                            <th>Date</th>
                            <th>Division Name</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th style="width: 6%; text-align: center">Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="add-stock-td">
                                    <div class="form-group">
                                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="stock_date" max="{{ date('Y-m-d') }}">
                                        @error('date')
                                        <div class="error-msg">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </td>
                                <td class="add-stock-td">
                                    <div class="form-group">
                                        <select class="form-control" name="division" id="division">
                                            @if(count($divisions))
                                                @foreach($divisions as $division)
                                                <option value="{{$division->id}}">{{$division->division_name}}</option>
                                                @endforeach
                                            @else
                                                <option value="">Not Available</option>
                                            @endif
                                        </select>
                                        @error('division')
                                        <div class="error-msg">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </td>
                                <td class="add-stock-td">
                                    <div class="form-group">
                                        <select class="form-control" name="product" id="product_dropdown">
                                            <option value="">Not Available</option>
                                        </select>
                                        @error('product')
                                        <div class="error-msg">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </td>
                                <td class="add-stock-td">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="sell_price" value="0.00" id="product_price" readonly>
                                        @error('sell_price')
                                        <div class="error-msg">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </td>
                                <td class="add-stock-td">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="qty" name="qty" value="1" min="0" onkeyup="calculateTotal()" onchange="calculateTotal()">
                                        @error('qty')
                                        <div class="error-msg">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </td>
                                <td class="add-stock-td">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="total" value="0.00" id="total_price">
                                    </div>
                                </td>
                                <td class="add-stock-td">
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary" id="issue_stock_btn" disabled><i class="glyphicon glyphicon-plus"></i> Issue Stock Items</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="low_stock_msg"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>All Issued Stocks</span>
            </strong>
        </div>
        <div class="panel-body">

            <div class="col-md-12 margin-bottom-10">
                <div class="row">
                    <div class="col-md-7"></div>
                    <div class="col-md-5">
                        <form action="/search-issued-stock" method="GET">
                            <div class="row">
                                <div class="col-md-8"><input type="text" style="padding: 18px 12px 18px 12px;font-size: 18px;" class="form-control" placeholder="Search Issued Stock..." name="search_issue_stock" value="{{isset($search) ? $search : '' }}"></div>
                                <div class="col-md-2 no-padding" style="padding-right: 4px">
                                    <button type="submit" class="btn btn-primary btn-block" style="font-size: 16px;"> <i class="glyphicon glyphicon-search"></i> Search</button>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <a href="/list-stock" type="submit" class="btn btn-danger btn-block" style="font-size: 16px;"> <i class="glyphicon glyphicon-remove"></i> Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover report-table">
                <thead>
                <tr>
                    <th style="width: 4%;" class="text-center">#</th>
                    <th class="text-center" style="width: 10%;">Date</th>
                    <th>Division Name</th>
                    <th>Product Name</th>
                    <th class="text-center">Price (Rs)</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Total (Rs)</th>
                    <th style="width: 6%; text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($stocks) > 0)
                        @php
                            $i = 1;
                        @endphp
                        @foreach($stocks as $stock)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td class="text-center">{{$stock->date}}</td>
                            <td>{{ $stock->division->division_name }}</td>
                            <td>{{$stock->product->name}}</td>
                            <td class="text-center">{{number_format($stock->price,2)}}</td>
                            <td class="text-center">{{$stock->qty}}</td>
                            <td class="text-center">{{ number_format($stock->total,2)}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="/get-edit-stock-form/{{$stock->id}}"
                                       class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a data-toggle="tooltip" title="Remove">
                                        <button type="button" class="btn btn-sm btn-danger" data-target="#deleteProd{{ $stock->id }}" data-toggle="modal">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteProd{{$stock->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Remove Product Stock</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <b>Are you sure you want to delete?</b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">No</button>
                                        <a href="/delete-stock/{{$stock->id}}" type="button" class="btn btn-danger">Yes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="7">
                            <div class="text-danger text-center"> <i class="glyphicon glyphicon-warning-sign"></i> Data not found!</div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <nav aria-label="...">
        <ul class="pagination">
            @if($stocks->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $stocks->previousPageUrl() }}" rel="prev" tabindex="-1">Previous</a>
            </li>
            @endif

            @for ($i = 1; $i <= $stocks->lastPage(); $i++)
            @if ($i == $stocks->currentPage())
            <li class="page-item active">
                <a class="page-link" href="{{ $stocks->url($i) }}">{{ $i }} <span class="sr-only">(current)</span></a>
            </li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $stocks->url($i) }}">{{ $i }}</a></li>
            @endif
            @endfor

            @if ($stocks->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $stocks->nextPageUrl() }}" rel="next">Next</a>
            </li>
            @else
            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
@endsection
