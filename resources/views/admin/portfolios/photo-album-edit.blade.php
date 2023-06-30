@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Photo Album : {{$photoAlbum->title}}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/portfolios/photo-albums')}}">Photo Album's</a></li>
                        <li class="breadcrumb-item"><a href="#!">Edit Photo Album : {{$photoAlbum->title}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 p-0">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 style="margin-top:17px;">Edit Photo Album : {{$photoAlbum->title}}</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/portfolios/photo-albums')}}" class="btn btn-success text-dark"><i class="fa fa-list"></i> Photo Album's</a>
                    </div>
                </div>             
            </div>
            <div class="card-body table-border-style">
                <hr>
                <div class="message">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                </div>  
                {{ Form::open(array('url' => 'admin/portfolios/photo-albums/edit/'.$photoAlbum->albumSlug , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    <input type="hidden" name="albumSlug" value="{{$photoAlbum->albumSlug}}" class="form-control">
                    <input type="hidden" name="id" value="{{encrypt($photoAlbum->id)}}" class="form-control">
                    <div class="row">
                        <div class="col-sm-8 col-md-8 col-lg-8" style="border-right:1px solid rgba(0, 0, 0, 0.1);">
                            <div class="form-row mt-4">                        
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Album Name <sup class="text-danger">*</sup></span>
                                        </div>
                                        <input type="text" class="form-control" required="" name="title" value="{{$photoAlbum->title}}" aria-label="" aria-describedby="basic-addon1">
                                    </div>
                                </div>                        
                            </div>
                            <div class="form-row mt-3">                        
                                <div class="form-group col-md-12">
                                    <div class="input-group cust-file-button">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Photos</span>
                                        </div>
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Images</label>
                                            <input type="file" name="albumimages[]" accept="image/*" id="images" multiple class="custom-file-input">
                                        </div>                                                                                                                                       
                                    </div>
                                    <small class="text-danger mt-2">Select multiple images.</small>
                                    <div class="images-preview-div"> </div>
                                    <div class="row mt-2">
                                        @php 
                                            $photos = unserialize($photoAlbum->portfolios_images);                                            
                                        @endphp
                                        @if(!empty($photos))
                                            @foreach($photos as $key=>$photo)
                                                <div class="col-sm-4 col-md-4 col-lg-4 mt-2">
                                                    <div class="card">
                                                        <div class="card-body" style="padding:5px 5px;"> 
                                                            <a href="{{$photo}}?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                                                                <img src="{{$photo}}?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="zoom img-fluid w-100" style="height:200px;" alt="">
                                                            </a> 
                                                            <a class="btn btn-danger mt-2 removeImage" data-key="{{$key}}" data-id="{{$photoAlbum->id}}" style="cursor:pointer;color:#fff;margin-left:20%;" onclick="return confirm('Are you sure, you want to delete it?')"><i class="fa fa-trash"></i> Remove</a>                                                                              
                                                        </div>
                                                    </div>                                             
                                                </div>
                                            @endforeach
                                        @endif                                        
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-row mt-4">                        
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Status</span>
                                        </div>
                                        <select class="custom-select" name="status" id="inputGroupSelect01">
                                            <option value="publish" @if($photoAlbum->status=='publish') seleceted @endif>Publish</option>
                                            <option value="unpublish" @if($photoAlbum->status=='unpublish') seleceted @endif>Un-Publish</option>
                                        </select>
                                    </div>
                                </div>                                                       
                            </div>
                            <div class="form-row mt-3">
                                <div class="form-group col-md-12">
                                    <div class="input-group cust-file-button">                                        
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Feature Image</label>
                                            <input type="file" name="featureImage" accept="image/*" id="featureImage" class="custom-file-input">
                                        </div>                                                                                               
                                    </div> 
                                    <div class="featureImage-preview-div"> 
                                        <img src="{{$photoAlbum->featureImage}}"/>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group text-center mt-2">
                                <button class="btn btn-info w-100" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')    
    <script>
        $(function() {
            var previewImages = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images').on('change', function() {  
                $('.images-preview-div').html('');     
                previewImages(this, 'div.images-preview-div');
            });

            $('#featureImage').on('change', function() {  
                $('.featureImage-preview-div').html('');     
                previewImages(this, 'div.featureImage-preview-div');
            });
            /***********************************/            
        });
        $(document).on('click', '.removeImage', function() { 
            const albumID = $(this).attr('data-id');
            const imageID = $(this).attr('data-key');
            $.ajax({
                type: 'get',
                datatype: 'json',
                url: "{{ URL::to('admin/portfolios/image-delete',) }}/" + albumID+"/"+imageID,
                beforeSend: function () {   
                    $(this).css('display','none');           
                },
                success: function (response) {
                    //$("#cartData").html(response);
                    location.reload();                
                },
                complete: function () {              
                }
            });
        });
    </script>
@endpush('scripts')