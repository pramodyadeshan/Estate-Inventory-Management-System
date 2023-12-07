@extends('../layout.layout')
@section('title', 'Media Files')

@section('content')

<div class="col-md-12">
    <p><h3><span class="glyphicon glyphicon-upload"></span> Upload Photos</h3></p>
    <form method="post" action="{{url('upload-file')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
        @csrf
        <div class="dz-default dz-message">
            <button class="dz-button" type="button" id="uploadButton">
                <i class="glyphicon glyphicon-cloud-upload"></i>
                <p>Click the Button or Drop Files Here</p>
            </button>
        </div>
    </form>
</div>
<hr>
<div class="container-fluid margin-top-60">

    <p>
        <h3>
            <span class="glyphicon glyphicon-camera"></span> All Photos <small>({{ count($list_media_files) }} of
                {{$totalImages}} Images)</small>
            <a href="/media-file" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Reload Page</a>
        </h3>
    </p>

    <div class="col-md-12">
        <div class="row">
            @if(count($list_media_files) > 0)
                @foreach($list_media_files as $list_media_file)
                <div class="col-md-2 image-div">
                    <img src="{{asset('uploads/product-images/').'/'.$list_media_file->file_name}}" class="img-responsive gallery-img" alt="gallery image" data-toggle="modal" data-target="#gallery_image{{$list_media_file->id}}">

                    <a href="/delete-media-file/{{$list_media_file->id}}" class="delete-button" onclick="return confirm('Are you sure delete this image?')"><i class="glyphicon glyphicon-trash text-white"></i></a>
                </div>

                <div id="gallery_image{{$list_media_file->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Gallery Image</h4>
                            </div>
                            <div class="modal-body">
                                <img src="{{asset('uploads/product-images/').'/'.$list_media_file->file_name}}" class="img-responsive" alt="gallery image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            @else
                <div class="alert alert-info text-center"><span class="glyphicon glyphicon-warning-sign"></span> Not found data!</div>
            @endif
        </div>
    </div>

    <nav aria-label="...">
        <ul class="pagination">
            @if($list_media_files->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $list_media_files->previousPageUrl() }}" rel="prev" tabindex="-1">Previous</a>
            </li>
            @endif

            @for ($i = 1; $i <= $list_media_files->lastPage(); $i++)
            @if ($i == $list_media_files->currentPage())
            <li class="page-item active">
                <a class="page-link" href="{{ $list_media_files->url($i) }}">{{ $i }} <span class="sr-only">(current)</span></a>
            </li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $list_media_files->url($i) }}">{{ $i }}</a></li>
            @endif
            @endfor

            @if ($list_media_files->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $list_media_files->nextPageUrl() }}" rel="next">Next</a>
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

