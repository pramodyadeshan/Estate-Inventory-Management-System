@extends('../layout.layout')

@section('title', 'Lowest Stock Products')

@section('content')

<div class="col-md-12">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>List Lowest Stock Product</span>
        </strong>
        </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped report-table">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Photo </th>
              <th>Product Title </th>
                <th class="text-center text-danger" style="width: 10%;color: red">In-Stock</th>
              <th class="text-center" style="width: 10%;">Division</th>
              <th class="text-center" style="width: 10%;">Categories</th>
              <th class="text-center" style="width: 10%;">Price (Rs)</th>
              <th class="text-center" style="width: 6%;">Status</th>
              <th class="text-center" style="width: 8%;">Preview</th>
            </tr>
          </thead>
          <tbody id="product_table">
            @if(count($lowest_stock_products) > 0)
                @php
                    $i = 1;
                @endphp
                @foreach ($lowest_stock_products as $lowest_stock_product)
                <tr>
                    <td class="text-center prod_td">{{$i++}}</td>
                    <td class="text-center">
                        @if($lowest_stock_product->image->file_name)
                        <img src="{{asset('uploads/product-images/').'/'.$lowest_stock_product->image->file_name}}" class="avatar-user-profile product-img" data-toggle="modal" data-target="#product_image{{$lowest_stock_product->id}}">
                        @else
                        <i class="glyphicon glyphicon-shopping-cart" class="avatar-user-profile"></i>
                        @endif
                    </td>
                    <td class="prod_td"><b>{{$lowest_stock_product->name}}</b></td>
                    <td class="text-center prod_td text-danger" style="font-size: 20px;color: red"><b>{{$lowest_stock_product->qty}}</b></td>
                    <td class="text-center prod_td">{{$lowest_stock_product->division->division_name}}</td>
                    <td class="text-center prod_td">{{$lowest_stock_product->category->cate_name}}</td>
                    <td class="text-center prod_td">{{ number_format($lowest_stock_product->sell_price,2) }}</td>
                    <td class="text-left prod-status">
                        @if($lowest_stock_product->isActive)
                        <span class="label label-success label-style-2">{{ __('Active') }}</span>
                        @else
                        <span class="label label-danger label-style-2">{{ __('Deactive') }}</span>
                        @endif
                    </td>
                    <td class="text-center prod_td_action">
                        <a href="#" data-toggle="tooltip" title="Preview">
                            <button type="button" class="btn btn-sm btn-info" data-target="#preview{{ $lowest_stock_product->id }}" data-toggle="modal">
                                <i class="glyphicon glyphicon-arrow-right"></i>
                            </button>
                        </a>
                    </td>
                </tr>

                <div id="preview{{$lowest_stock_product->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Preview Product</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 text-center">
                                    <img src="{{asset('uploads/product-images/').'/'.$lowest_stock_product->image->file_name}}" alt="Product image" class="img-thumbnail">
                                </div>
                                <div class="col-md-12">
                                    <h3 class="text-dark text-danger"><b>Product Information</b></h3>

                                    <div class="col-md-12 border-top border-bottom margin-top-10">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Title <p class="pull-right">-</p> </b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$lowest_stock_product->name}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Division <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$lowest_stock_product->division->division_name}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Categories <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$lowest_stock_product->category->cate_name}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>In-Stock <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$lowest_stock_product->qty}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Buying Price (Rs) <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>Rs. {{ number_format($lowest_stock_product->buy_price,2) }}</b></h4></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Selling Price (Rs) <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>Rs. {{ number_format($lowest_stock_product->sell_price,2) }}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Manufacture Date<p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{ $lowest_stock_product->manu_date }}</b></h4></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Expire Date<p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{ $lowest_stock_product->exp_date }}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Product Added <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$lowest_stock_product->created_at ? $lowest_stock_product->created_at : 'N/A'}}</b></h4></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Created By <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$lowest_stock_product->user->name}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Status <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis margin-top-10">
                                                @if($lowest_stock_product->isActive)
                                                <span class="label label-success label-style-2">{{ __('Active') }}</span>
                                                @else
                                                <span class="label label-danger label-style-2">{{ __('Deactive') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default margin-top-10" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div id="product_image{{$lowest_stock_product->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Product Image</h4>
                            </div>
                            <div class="modal-body">
                                <img src="{{asset('uploads/product-images/').'/'.$lowest_stock_product->image->file_name}}" class="img-responsive" alt="Product image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                @endforeach
            @else
                <tr>
                    <td colspan="10">
                        <div class="alert alert-info text-center"><span class="glyphicon glyphicon-warning-sign"></span> Not found data!</div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
      </div>
      </div>

        <nav aria-label="...">
            <ul class="pagination">
                @if($lowest_stock_products->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $lowest_stock_products->previousPageUrl() }}" rel="prev" tabindex="-1">Previous</a>
                </li>
                @endif

                @for ($i = 1; $i <= $lowest_stock_products->lastPage(); $i++)
                @if ($i == $lowest_stock_products->currentPage())
                <li class="page-item active">
                    <a class="page-link" href="{{ $lowest_stock_products->url($i) }}">{{ $i }} <span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $lowest_stock_products->url($i) }}">{{ $i }}</a></li>
                @endif
                @endfor

                @if ($lowest_stock_products->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $lowest_stock_products->nextPageUrl() }}" rel="next">Next</a>
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
