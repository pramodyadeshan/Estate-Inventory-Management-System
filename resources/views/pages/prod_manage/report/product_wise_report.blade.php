@extends('../layout.layout')

@section('title', 'Reports')

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-12 margin-top-20">
            <div class="d-inline-flex">
                <div class="p-2"><a href="/list-reports">Back</a></div>
                <div class="p-2"><h2>Product Wise Report</h2></div>
            </div>
        </div>
        <div class="col-md-12 margin-top-20">

            <a href="/download-product-wise-PDF" class="btn btn-primary"><i class="glyphicon glyphicon-download-alt"></i> Download Report</a>

            <hr>
            <div class="page-break report" id="report-summary">
                <div class="report-head">
                    <h1>{{ __( session('title') ) }} - Product Wise Report</h1>
                </div>
                <table class="table table-border report-table">
                    <thead>
                    <tr>
                        <th class="text-left" style="text-align: center">ID</th>
                        <th class="text-left">Add Date</th>
                        <th class="text-left">Product Name</th>
                        <th class="text-left">Category Name</th>
                        <th class="text-left">Division Name</th>
                        <th class="text-left">In-stock</th>
                        <th class="text-left">Buy Price (Rs)</th>
                        <th class="text-left">Sell Price (Rs)</th>
                        <th class="text-left">Manufacture Date</th>
                        <th class="text-left">Expired Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($products))
                        @foreach($products as $product)
                            <tr>
                                <td class="text-left" style="text-align: center">{{$product->id}}</td>
                                <td class="text-left">{{$product->created_at}}</td>
                                <td class="text-left"><b>{{$product->name}}</b></td>
                                <td class="text-left">{{$product->category->cate_name}}</td>
                                <td class="text-left">{{$product->division->division_name}}</td>
                                <td class="text-left">{{$product->qty}}</td>
                                <td class="text-left">{{$product->buy_price}}</td>
                                <td class="text-left">{{$product->sell_price}}</td>
                                <td class="text-left">{{$product->manu_date}}</td>
                                <td class="text-left">{{$product->exp_date}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">
                                <div class="alert alert-default text-center"><span class="glyphicon glyphicon-warning-sign"></span> Not found data!</div>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <nav aria-label="...">
                <ul class="pagination">
                    @if($products->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev" tabindex="-1">Previous</a>
                    </li>
                    @endif

                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                    @if ($i == $products->currentPage())
                    <li class="page-item active">
                        <a class="page-link" href="{{ $products->url($i) }}">{{ $i }} <span class="sr-only">(current)</span></a>
                    </li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a></li>
                    @endif
                    @endfor

                    @if ($products->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">Next</a>
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
    <div class="col-md-1"></div>
</div>
@endsection
