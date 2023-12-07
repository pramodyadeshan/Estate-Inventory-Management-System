@extends('../layout.layout')

@section('title', 'Edit Category')

@section('content')

<div class="row margin-top">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Edit Category</span>
                </strong>
                <small class="back-text-right">
                    <a href="/cate-manage" class="text-decoration-none">Back</a>
                </small>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{url('edit-auth-category', $category_record->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category">Category Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="category_name" placeholder="Category Name" value="{{$category_record->cate_name}}">
                        @error('category_name')
                        <div class="error-msg">
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update Category</button>
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
