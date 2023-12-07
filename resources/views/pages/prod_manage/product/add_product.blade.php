@extends('../layout.layout')

@section('title', 'Add New Product')

@section('content')
<script>
    var assetPath = "{{ asset('uploads/product-images/') }}";
</script>

<div class="contain">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default add-user-form">
            <div class="panel-heading">
              <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Add New Product</span>
             </strong>
             <small class="back-text-right">
                <a href="/list-product" class="text-decoration-none">Back</a>
             </small>
            </div>
            <div class="panel-body">
               <form method="post" action="/add-auth-product" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                      <label for="title">Title<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="title" placeholder="Product Title" autofocus>
                      @error('title')
                      <div class="error-msg">
                          <span class="text-danger">{{ $message }}</span>
                      </div>
                      @enderror
                  </div>
                   <div class="form-group">
                       <label for="division">Division Name<span class="text-danger">*</span></label>
                       <select class="form-control" name="division">
                           <option value="">Select Division Name</option>
                           @foreach($divisions as $division)
                           <option value="{{$division->id}}">{{$division->division_name}}</option>
                           @endforeach
                       </select>
                       @error('division')
                       <div class="error-msg">
                           <span class="text-danger">{{ $message }}</span>
                       </div>
                       @enderror
                   </div>
                   <div class="form-group">
                       <label for="exp_date">Category Name<span class="text-danger">*</span></label>
                       <select class="form-control" name="category">
                           <option value="">Select Category Name</option>
                           @foreach($categories as $category)
                           <option value="{{$category->id}}">{{$category->cate_name}}</option>
                           @endforeach
                       </select>
                       @error('category')
                       <div class="error-msg">
                           <span class="text-danger">{{ $message }}</span>
                       </div>
                       @enderror
                   </div>
                  <div class="form-group">
                      <label for="qty">Quantity<span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="qty" placeholder="Quantity">
                      @error('qty')
                      <div class="error-msg">
                          <span class="text-danger">{{ $message }}</span>
                      </div>
                      @enderror
                  </div>
                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                               <label for="buy_price">Unit Purchase Price<span class="text-danger">*</span></label>
                               <input type="text" class="form-control" name="buy_price"  placeholder="Unit Purchase Price(Rs)">
                               @error('buy_price')
                               <div class="error-msg">
                                   <span class="text-danger">{{ $message }}</span>
                               </div>
                               @enderror
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <label for="sell_price">Unit Sell Price<span class="text-danger">*</span></label>
                               <input type="text" class="form-control" name="sell_price"  placeholder="Unit Sell Price(Rs)">
                               @error('sell_price')
                               <div class="error-msg">
                                   <span class="text-danger">{{ $message }}</span>
                               </div>
                               @enderror
                           </div>
                       </div>
                   </div>

                   <div class="row margin-bottom-20">
                       <div class="col-md-12">
                           <div class="row">
                               <div class="col-md-2 text-center">
                                   <img src="{{asset('uploads/product-images/').'/1701108595.png'}}" id="selectedImage" alt="product image" class="text-center">
                               </div>
                               <div class="col-md-10">
                                   <label for="manu_date">Choose product image</label>
                                   <button type="button" class="btn btn-primary btn-block w-100" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="glyphicon glyphicon-picture"></i> Choose Image</button>
                               </div>
                           </div>
                       </div>

                       <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-lg">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title" id="uploadModalLabel">Select Image</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body img-select-modal">
                                       <div class="row">
                                           @if(count($list_media_files) > 0)
                                               @foreach($list_media_files as $list_media_file)
                                               <div class="col-md-4 image-div">
                                                   <input type="radio" class="img-modal-radio" onclick="changeFormImage('{{$list_media_file->file_name}}',assetPath)" name="img_id" value="{{$list_media_file->id}}" id="img{{$list_media_file->id}}">
                                                   <img src="{{asset('uploads/product-images/').'/'.$list_media_file->file_name}}" onclick="document.getElementById('img{{$list_media_file->id}}').click();" for="image_name" class="img-thumbnail gallery-img" alt="gallery image" data-toggle="modal" data-target="#gallery_image{{$list_media_file->id}}" data-dismiss="modal">
                                               </div>
                                               @endforeach
                                           @else
                                                <div class="alert alert-info text-center"><span class="glyphicon glyphicon-warning-sign"></span> Not found data!</div>
                                           @endif
                                       </div>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="manu_date">Manufacture Date</label>
                       <input type="date" class="form-control" name="manu_date"  placeholder="Manufacture Date" value="{{ date('Y-m-d') }}">
                       @error('manu_date')
                       <div class="error-msg">
                           <span class="text-danger">{{ $message }}</span>
                       </div>
                       @enderror
                   </div>
                   <div class="form-group">
                       <label for="exp_date">Expire Date</label>
                       <input type="date" class="form-control" name="exp_date"  placeholder="Expire Date" value="{{ date('Y-m-d', strtotime('+1 month')) }}">
                       @error('exp_date')
                       <div class="error-msg">
                           <span class="text-danger">{{ $message }}</span>
                       </div>
                       @enderror
                   </div>
                  <div class="form-group clearfix">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                  </div>
              </form>

              @if(session('success'))
                <div class="alert alert-success text-center alert-msg"><strong>Success : {{session('success')}}!</strong></div>
              @endif
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
    </div>
  </div>
</div>
@endsection
