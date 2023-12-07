@extends('../layout.layout')

@section('title', 'Edit Product Stock')

@section('content')

<div class="row margin-top-60">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Edit Product Stock</span>
                </strong>
                <small class="back-text-right">
                    <a href="/list-stock" class="text-decoration-none">Back</a>
                </small>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{url('edit-auth-stock', $stocks->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="date">Date </label>
                        <input type="date" class="form-control" value="{{ $stocks->date }}" name="stock_date" max="{{ date('Y-m-d') }}">
                        @error('stock_date')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date">Division Name</label>
                        <select class="form-control" name="division" id="division_update">
                           <option value="{{ $stocks->division_id }}">{{ $stocks->division->division_name }}</option>
                            @foreach($divisions as $division)
                                @if($division->id != $stocks->division_id)
                                    <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('division')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date">Product Name</label>
                        <select class="form-control" name="product" id="product_update">
                            <option value="{{ $stocks->product_id }}">{{ $stocks->product->name }}</option>
                            @if(count($products))
                                @foreach($products as $product)
                                    @if($product->id != $stocks->product_id)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endif
                                @endforeach
                            @else
                                <option value="">Not Available</option>
                            @endif
                        </select>
                        @error('product')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date">Price</label>
                        <input type="number" class="form-control" name="sell_price" value="{{number_format($stocks->price,2)}}" id="product_price_update" readonly>
                    </div>
                    <div class="form-group">
                        <label for="date">Quantity</label>
                        <input type="number" class="form-control" name="qty" value="{{number_format($stocks->qty)}}" min="0" id="qty_update" onchange="calculateUpdateTotal()" onkeyup="calculateUpdateTotal()">
                        @error('qty')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date">Total Price</label>
                        <input type="number" class="form-control" name="total" readonly value="{{ number_format($stocks->total,2) }}" id="total_price_update">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Stock</button>
                </form>

                @if(session('success'))
                <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>

@endsection
