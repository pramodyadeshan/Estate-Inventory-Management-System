@extends('../layout.layout')

@section('title', 'Product Management')

@section('content')

<div class="col-md-12">

  @if(session('success'))
    <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
  @elseif(session('error'))
    <div class="alert alert-danger text-center alert-msg"><strong>Error : {{session('error')}}!</strong></div>
  @endif

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>List Product</span>
        </strong>
          <a href="/add-product" class="btn btn-info pull-right">Add Product</a>
        </div>
      <div class="panel-body">
          <div class="col-md-12 margin-bottom-10">
              <div class="row">
                  <div class="col-md-7"></div>
                  <div class="col-md-5">
                    <form action="/search-product" method="GET">
                      <div class="row">
                          <div class="col-md-8"><input type="text" style="padding: 18px 12px 18px 12px;font-size: 18px;" class="form-control" placeholder="Search Product..." name="search_product" value="{{isset($search) ? $search : '' }}"></div>
                          <div class="col-md-2 no-padding" style="padding-right: 4px">
                              <button type="submit" class="btn btn-primary btn-block" style="font-size: 16px;"> <i class="glyphicon glyphicon-search"></i> Search</button>
                          </div>
                          <div class="col-md-2 no-padding">
                              <a href="/list-product" type="submit" class="btn btn-danger btn-block" style="font-size: 16px;"> <i class="glyphicon glyphicon-remove"></i> Clear</a>
                          </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
        <table class="table table-bordered table-striped report-table">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Photo </th>
              <th>Product Title </th>
              <th class="text-center" style="width: 10%;">Division</th>
              <th class="text-center" style="width: 10%;">Categories</th>
              <th class="text-center" style="width: 10%;">In-Stock</th>
              <th class="text-center" style="width: 10%;">Buying Price (Rs)</th>
              <th class="text-center" style="width: 10%;">Selling Price (Rs)</th>
              <th class="text-center" style="width: 6%;">Status</th>
              <th class="text-center" style="width: 8%;">Actions</th>
            </tr>
          </thead>
          <tbody id="product_table">
            @if(count($list_products) > 0)
                @php
                    $i = 1;
                @endphp
                @foreach ($list_products as $list_product)
                <tr>
                    <td class="text-center prod_td">{{$i++}}</td>
                    <td class="text-center">
                        @if($list_product->image->file_name)
                        <img src="{{asset('uploads/product-images/').'/'.$list_product->image->file_name}}" class="avatar-user-profile product-img" data-toggle="modal" data-target="#product_image{{$list_product->id}}">
                        @else
                        <i class="glyphicon glyphicon-shopping-cart" class="avatar-user-profile"></i>
                        @endif
                    </td>
                    <td class="prod_td"><b>{{$list_product->name}}</b></td>
                    <td class="text-center prod_td">{{$list_product->division->division_name}}</td>
                    <td class="text-center prod_td">{{$list_product->category->cate_name}}</td>
                    <td class="text-center prod_td">{{$list_product->qty}}</td>
                    <td class="text-center prod_td">{{ number_format($list_product->buy_price,2) }}</td>
                    <td class="text-center prod_td">{{ number_format($list_product->sell_price,2) }}</td>
                    <td class="text-left prod-status">
                        @if($list_product->isActive)
                        <span class="label label-success label-style-2">{{ __('Active') }}</span>
                        @else
                        <span class="label label-danger label-style-2">{{ __('Deactive') }}</span>
                        @endif
                    </td>
                    <td class="text-center prod_td_action">
                        <a href="#" data-toggle="tooltip" title="Preview">
                            <button type="button" class="btn btn-sm btn-info" data-target="#preview{{ $list_product->id }}" data-toggle="modal">
                                <i class="glyphicon glyphicon-arrow-right"></i>
                            </button>
                        </a>
                        <div class="btn-group">
                            <a href="/edit-product/{{ $list_product->id }}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            <a href="#" data-toggle="tooltip" title="Remove">
                                <button type="button" class="btn btn-sm btn-danger" data-target="#deleteProd{{ $list_product->id }}" data-toggle="modal">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>

                <div id="preview{{$list_product->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Preview Product</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 text-center">
                                    <img src="{{asset('uploads/product-images/').'/'.$list_product->image->file_name}}" alt="Product image" class="img-thumbnail">
                                </div>
                                <div class="col-md-12">
                                    <h3 class="text-dark text-danger"><b>Product Information</b></h3>

                                    <div class="col-md-12 border-top border-bottom margin-top-10">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Title <p class="pull-right">-</p> </b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$list_product->name}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Division <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$list_product->division->division_name}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Categories <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$list_product->category->cate_name}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>In-Stock <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$list_product->qty}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Buying Price (Rs) <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>Rs. {{ number_format($list_product->buy_price,2) }}</b></h4></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Selling Price (Rs) <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>Rs. {{ number_format($list_product->sell_price,2) }}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Manufacture Date<p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{ $list_product->manu_date }}</b></h4></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Expire Date<p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{ $list_product->exp_date }}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Product Added <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$list_product->created_at ? $list_product->created_at : 'N/A'}}</b></h4></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Created By <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis"><h4><b>{{$list_product->user->name}}</b></h4></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 no-padding text-secondary"><h4><b>Status <p class="pull-right">-</p></b></h4></div>
                                            <div class="col-md-8 text-dark-emphasis margin-top-10">
                                                @if($list_product->isActive)
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

                <div id="product_image{{$list_product->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Product Image</h4>
                            </div>
                            <div class="modal-body">
                                <img src="{{asset('uploads/product-images/').'/'.$list_product->image->file_name}}" class="img-responsive" alt="Product image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal fade" id="deleteProd{{ $list_product->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Remove Stock</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <b>Are you sure you want to delete?</b>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">No</button>
                                <a href="/delete-product/{{ $list_product->id }}" type="button" class="btn btn-danger">Yes</a>
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
                @if($list_products->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $list_products->previousPageUrl() }}" rel="prev" tabindex="-1">Previous</a>
                </li>
                @endif

                @for ($i = 1; $i <= $list_products->lastPage(); $i++)
                @if ($i == $list_products->currentPage())
                <li class="page-item active">
                    <a class="page-link" href="{{ $list_products->url($i) }}">{{ $i }} <span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $list_products->url($i) }}">{{ $i }}</a></li>
                @endif
                @endfor

                @if ($list_products->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $list_products->nextPageUrl() }}" rel="next">Next</a>
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
