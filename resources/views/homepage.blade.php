@extends('layout.layout')

@section('title', 'Home Page')

@section('content')

    <h2><b>{{ __('Hello ') }}</b> {{ Auth::user()->name }},</h2>

    <div class="row margin-top-20">
    <a href="#" style="color:black;">
	<div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-secondary1">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> {{$user_count}} </h2>
          <p class="text-muted">Users</p>
        </div>
       </div>
    </div>
	</a>

	<a href="#" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> {{$category_count}} </h2>
          <p class="text-muted">Categories</p>
        </div>
       </div>
    </div>
	</a>

	<a href="#" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> {{$product_count}} </h2>
          <p class="text-muted">Products</p>
        </div>
       </div>
    </div>
	</a>

	<a href="#" style="color:black;">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> Rs {{number_format($stock_amount,2)}}</h2>
          <p class="text-muted">Total Stock <br>
              <small><i>(For Today)</i></small>
          </p>
        </div>
       </div>
    </div>
	</a>
</div>

  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Highest Issued Products</span>
         </strong>
       </div>
       <div class="panel-body" style="max-height: 600px;overflow: auto">
         <table class="table table-striped table-bordered table-condensed report-table">
          <thead>
           <tr>
             <th class="text-center">#</th>
             <th>Product Name</th>
             <th class="text-center" style="width: 30%;">Total Quantity</th>
           <tr>
          </thead>
          <tbody>
          @if(count($product_quantities) > 0)
              @php
                $i = 1;
              @endphp
              @foreach($product_quantities as $product_quantity)
              <tr>
                  <td class="text-center">{{$i++}}</td>
                  <td>{{$product_quantity->product->name}}</td>
                  <td class="text-center" style="font-size: 18px;"><b>{{$product_quantity->total_quantity}}</b></td>
              </tr>
              @endforeach
          @else
          <tr>
              <td class="text-center" colspan="4">
                  <div class="text-danger text-center"> <i class="glyphicon glyphicon-warning-sign"></i> Data not found!</div>
              </td>
          </tr>
          @endif
          <tbody>
         </table>
       </div>
         <div class="panel-footer"></div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Highest Latest Issue Products</span>
          </strong>
        </div>
        <div class="panel-body" style="max-height: 600px;overflow: auto;">
        <table class="table table-striped table-bordered table-condensed report-table">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px;">#</th>
           <th style="width: 25%;text-align: center">Date</th>
           <th>Product Name</th>
           <th class="text-center">Total Quantity</th>
         </tr>
       </thead>
       <tbody>
       @if(count($top_latest_issue_items) > 0)
           @php
             $i = 1;
           @endphp
           @foreach($top_latest_issue_items as $top_latest_issue_item)
           <tr>
               <td class="text-center">{{$i++}}</td>
               <td class="text-center">{{$top_latest_issue_item->date}}</td>
               <td>{{$top_latest_issue_item->product->name}}</td>
               <td class="text-center" style="font-size: 18px;"><b>{{$top_latest_issue_item->qty}}</b></td>
           </tr>
           @endforeach
       @else
           <tr>
               <td class="text-center" colspan="4">
                   <div class="text-danger text-center"> <i class="glyphicon glyphicon-warning-sign"></i> Data not found!</div>
               </td>
           </tr>
       @endif
       </tbody>
     </table>
    </div>
    <div class="panel-footer"></div>
   </div>
  </div>
      <div class="col-md-4">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <strong>
                      <span class="glyphicon glyphicon-th"></span>
                      <span>Lowest Stock Products</span>
                      <span class="text-muted"><a href="/lowest-product" style="color:blue" class="pull-right">See all</a></span>
                  </strong>
              </div>
              <div class="panel-body" style="max-height: 600px;overflow: auto;">
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
              <div class="panel-footer"></div>
          </div>
      </div>
</div>

@endsection
